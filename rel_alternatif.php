<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="rel_alternatif" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?=$_GET['q']?>" placeholder="Pencarian..." />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
        </form>
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
                <th>Aksi</th>
                </tr>     
            </thead>
            <?php foreach($data as $key => $value):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$ALTERNATIF[$key]?></td>
                <?php foreach($value as $k => $v):?>
                <td><?=$v?></td>
                <?php endforeach;?>
                <td>
                <a class="btn btn-xs btn-warning" href="?m=rel_alternatif_ubah&ID=<?=$key?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>        
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>