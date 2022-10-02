<?php
error_reporting(~E_NOTICE);
session_start();

DEFINE('ABSPATH', dirname(__FILE__) . '/');

include ABSPATH . 'config.php';
include ABSPATH . 'includes/db.php';
include ABSPATH . 'includes/general.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);

$mod = $_GET['m'];
$act = $_GET['act'];

$rows = $db->get_results("SELECT * from tb_alternatif");
foreach ($rows as $row) {
    $ALTERNATIF[$row->kode_alternatif] = $row->nama_alternatif;
}

$rows = $db->get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
foreach ($rows as $row) {
    $KRITERIA[$row->kode_kriteria] = $row;
}
//mengatur hak akses dari admin dan user
function is_able($mod)
{
    if (!$_SESSION['level'])
        $_SESSION['level'] = 'guest';
    $role = array(
        'admin' => array(
            'user',
            'alternatif',
            'kriteria',
            'rel_alternatif',
            'hitung',
        ),
        'user' => array(
            'hitung',
        ),
    );

    return in_array($mod, (array) $role[strtolower($_SESSION['level'])]);
}
//jika tidak mempunyai akses maka dihidden
function is_hidden($mod)
{
    return (is_able($mod)) ? '' : 'hidden';
}
function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

function get_data()
{
    global $db;

    $rows = $db->get_results("SELECT a.kode_alternatif, k.kode_kriteria, ra.nilai
        FROM tb_alternatif a 
            INNER JOIN tb_rel_alternatif ra ON ra.kode_alternatif=a.kode_alternatif
            INNER JOIN tb_kriteria k ON k.kode_kriteria=ra.kode_kriteria
            ORDER BY a.kode_alternatif, k.kode_kriteria");
    $data = array();
    foreach ($rows as $row) {
        $data[$row->kode_alternatif][$row->kode_kriteria] = $row->nilai;
    }
    return $data;
}

function get_data_cb($data)
{
    global $KRITERIA;
    $arr = array();
    foreach ($data as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = $KRITERIA[$k]->atribut == 'benefit' ? $v : $v * -1;
        }
    }
    return $arr;
}

function get_minmax($data_cb)
{
    $arr = array();
    $arr2 = array();
    foreach ($data_cb as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$k][$key] = $v;
        }
    }
    foreach ($arr as $key => $val) {
        $arr2['max'][$key] = max($val);
        $arr2['min'][$key] = min($val);
    }
    return $arr2;
}

function get_nij($data, $minmax)
{
    $arr = array();
    foreach ($data as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = ($minmax['max'][$k] - $v) / ($minmax['max'][$k] - $minmax['min'][$k]);
        }
    }
    return $arr;
}

function get_terbobot($data)
{
    global $KRITERIA;
    $arr = array();
    foreach ($data as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = $v * $KRITERIA[$k]->bobot;
        }
    }
    return $arr;
}

function get_utilitas_regret($terbobot)
{
    $arr = array();
    foreach ($terbobot as $key => $val) {
        $arr['s'][$key] = array_sum($val);
        $arr['r'][$key] = max($val);
    }
    return $arr;
}


function get_q($sr, $var)
{

    $arr = array();

    $s_plus = max($sr['s']);
    $s_min = min($sr['s']);

    $r_plus = max($sr['r']);
    $r_min = min($sr['r']);

    foreach ($var as $k => $v) {
        foreach ($sr['s'] as $key => $val) {
            $si = $sr['s'][$key];
            $ri = $sr['r'][$key];

            $xs = $s_plus == $s_min ? 0 : ($si - $s_min) / ($s_plus - $s_min);
            $xr = $r_plus == $r_min ? 0 : ($ri - $r_min) / ($r_plus - $r_min);
            $arr[$key][$k] = $v * $xs + (1 - $v) * $xr;
        }
    }

    return $arr;
}

function get_rank_q($q)
{
    $arr = array();

    foreach ($q as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$k][$key] = $v;
        }
    }

    $arr2 = array();
    foreach ($arr as $key => $val) {
        $arr2[$key] = get_rank($val);
    }

    $arr3 = array();
    foreach ($arr as $key => $val) {
        foreach ($val as $k => $v) {
            $arr3[$k][$key] = $arr2[$key][$k];
        }
    }
    //echo '<pre>' . print_r($arr3, 1) .'</pre>';
    return $arr3;
}

function get_rata($rank_q)
{
    $arr = array();
    foreach ($rank_q as $key => $val) {
        $arr[$key] = array_sum($val) / count($val);
    }
    return $arr;
    //echo '<pre>' . print_r($rank_q, 1) .'</pre>';
}

function get_rank($array)
{
    $data = $array;
    asort($data);
    $no = 1;
    $new = array();
    foreach ($data as $key => $value) {
        $new[$key] = $no++;
    }
    return $new;
}

function get_atribut_option($selected = '')
{
    $atribut = array('benefit' => 'Benefit', 'cost' => 'Cost');
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}
