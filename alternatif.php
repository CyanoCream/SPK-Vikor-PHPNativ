<div class="page-header">
    <h1>Alternatif</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="alternatif" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=alternatif_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Alternatif</th>
            </tr>
        </thead>
        <?php
        $q = $_GET['q'];
       
        $rows = $db->get_results("SELECT * FROM tb_alternatif 
            WHERE  kode_alternatif LIKE '%$q%' OR nama_alternatif LIKE '%$q%' 
            ORDER BY kode_alternatif");
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_alternatif ?></td>
            <td><?=$row->nama_alternatif?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=alternatif_ubah&amp;ID=<?=$row->kode_alternatif?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=alternatif_hapus&amp;ID=<?=$row->kode_alternatif?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;?>
        </table>
    </div>
</div>