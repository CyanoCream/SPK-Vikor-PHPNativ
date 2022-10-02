<div class="page-header">
    <h1>Perhitungan</h1>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Hasil Analisa</h3>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <th>Nama</th>
                <?php    
                $data = get_data();                 
                foreach($KRITERIA as $key => $val):?>
                <th><?=$val->nama_kriteria?></th>
                <?php endforeach;?> 
            </tr></thead>
            <?php foreach($data as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$ALTERNATIF[$key]?></td>
                <?php foreach($val as $k => $v):?>
                <td><?=round($v,3)?></td>
                <?php endforeach;?>
            </tr>
            <?php endforeach?>
            <tfoot><tr>
                <td colspan="2">Cost/Benefit</td>
                <?php foreach($KRITERIA as $key => $val):?>
                <td><?=$val->atribut=='benefit' ? 1 : -1?></td>
                <?php endforeach?>
            </tr></tfoot>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Konversi</h3>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <th>Nama</th>
                <?php    
                $data_cb = get_data_cb($data);  
                $minmax = get_minmax($data_cb);
                foreach($KRITERIA as $key => $val):?>
                <th><?=$val->nama_kriteria?></th>
                <?php endforeach;?> 
            </tr></thead>
            <?php foreach($data_cb as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$ALTERNATIF[$key]?></td>
                <?php foreach($val as $k => $v):?>
                <td><?=round($v,3)?></td>
                <?php endforeach?>
            </tr>
            <?php endforeach?>
            <tfoot><tr>
                <td colspan="2">Max</td>
                <?php foreach($minmax['max'] as $key => $val):?>
                <td><?=$val?></td>
                <?php endforeach?>
            </tr><tr>
                <td colspan="2">Min</td>
                <?php foreach($minmax['min'] as $key => $val):?>
                <td><?=$val?></td>
                <?php endforeach?>
            </tr></tfoot>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">N<sub>ij</h3>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <?php    
                $nij = get_nij($data_cb, $minmax);  
                foreach($KRITERIA as $key => $val):?>
                <th><?=$key?></th>
                <?php endforeach;?> 
            </tr></thead>
            <?php foreach($nij as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <?php foreach($val as $k => $v):?>
                <td><?=round($v,3)?></td>
                <?php endforeach?>
            </tr>
            <?php endforeach?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Terbobot</h3>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <?php    
                $terbobot = get_terbobot($nij);  
                foreach($KRITERIA as $key => $val):?>
                <th><?=$key?></th>
                <?php endforeach;?> 
            </tr></thead>
            <?php foreach($terbobot as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <?php foreach($val as $k => $v):?>
                <td><?=round($v,3)?></td>
                <?php endforeach?>
            </tr>
            <?php endforeach?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Nilai Utilitas (S) dan Ukuran Regret (R)</h3>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <?php                    
                $sr = get_utilitas_regret($terbobot);
                foreach($KRITERIA as $key => $value):?>
                <th><?=$key?></th>
                <?php endforeach;?> 
                <th>S</th> 
                <th>R</th>
            </tr></thead>
            <?php foreach($terbobot as $key => $value):?>
            <tr>
                <td><?=$key?></td>
                <?php foreach($value as $k => $v):?>
                <td><?=round($v,3)?></td>
                <?php endforeach;?>
                <td><?=round($sr['s'][$key], 3)?></td>
                <td><?=round($sr['r'][$key], 3)?></td>
            </tr>
            <?php endforeach;?>
            <tr>
                <td colspan="<?=count($KRITERIA) + 1?>" class="text-right">S*</td>
                <td><?=round(max($sr['s']), 3)?></td>
                <td>&nbsp;</td>
            </tr><tr>
                <td colspan="<?=count($KRITERIA) + 1?>" class="text-right">S-</td>
                <td><?=round(min($sr['s']), 3)?></td>
                <td>&nbsp;</td>
            </tr><tr>
                <td colspan="<?=count($KRITERIA) + 1?>" class="text-right">R*</td>
                <td>&nbsp;</td>
                <td><?=round(max($sr['r']), 3)?></td>
            </tr><tr>
                <td colspan="<?=count($KRITERIA) + 1?>" class="text-right">R-</td>
                <td>&nbsp;</td>
                <td><?=round(min($sr['r']), 3)?></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Indeks Vikor</h3>
    </div>
    <div class="table-responsive"> 
        <?php
        $indeks = array(0.4, 0.5, 0.6);
        $q = get_q($sr, $indeks);
        $rank_q = get_rank_q($q);
        $rata = get_rata($rank_q);
        $rank_rata = get_rank($rata);
        ?>
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th rowspan="2">Kode</th>
                <th colspan="<?=count($indeks)?>">Indeks Vikor (Q)</th>                
                <th colspan="<?=count($indeks)?>">Rank</th>
                <th rowspan="2">Rata</th>
            </tr><tr>
                <?php foreach($indeks as $key => $val):?>
                <th>v=<?=$val?></th>
                <?php endforeach?>
                <?php foreach($indeks as $key => $val):?>
                <th>v<?=$key+1?></th>
                <?php endforeach?>
            </tr></thead>
            <?php             
            foreach($rank_rata as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <?php foreach($q[$key] as $k => $v):?>
                <td><?=round($v,3)?></td>
                <?php endforeach?>
                <?php foreach($q[$key] as $k => $v):?>
                <td><?=$rank_q[$key][$k]?></td>
                <?php endforeach?>
                <td><?=round($rata[$key],3)?></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>