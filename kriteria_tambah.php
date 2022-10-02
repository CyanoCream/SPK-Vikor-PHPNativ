<div class="page-header">
    <h1>Tambah Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" readonly="readonly" name="kode" value="<?=set_value('kode',kode_oto('kode_kriteria', 'tb_kriteria', 'C', 2))?>"/>
            </div>
            <div class="form-group">
                <label>Nama Kriteria<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=set_value('nama')?>"/>
            </div>
            <div class="form-group">
                <label>Atribut <span class="text-danger">*</span></label>
                <select class="form-control" name="atribut">
                    <option></option>
                    <?=get_atribut_option(set_value('atribut'))?>
                </select>
            </div>
            <div class="form-group">
                <label>Bobot <span class="text-danger"></span></label>
               <input class="form-control" type="text" name="bobot" value="<?=set_value('bobot')?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>