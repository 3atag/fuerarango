<div class="crear_internacion">
    <h4>Agregar Internacion</h4>

    <form action="save" method="post">

        <div class="form-group">
            <label for="paciente">Paciente</label>
            <div class="input-group">

                <input type="number" name="paciente" id="paciente" class="form-control">

                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#modalAddPaciente">Seleccionar</button>
                </div>
            </div>

        </div>


        <div class="form-group">
            <label for="fechaIng">Fecha ingreso</label>
            <input type="datetime-local" name="fechaIng" id="fechaIng" class="form-control">
        </div>

        <div class="form-group">
            <label for="fechaEgr">Fecha Egreso</label>
            <input type="datetime-local" name="fechaEgr" id="fechaEgr" class="form-control">
        </div>

        <input type="submit" value="Agregar" class="btn btn-primary">
    </form>
</div>

<div class="modal fade" id="modalAddPaciente" tabindex="-1" role="dialog" aria-labelledby="modalAddPaciente" aria-hidden="true">

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Seleccionar paciente
            </h5>
            <button class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">

        <div>
    <h1>Listado de pacientes</h1>
    <p><?php echo $listado; ?></p>
</div>
        </div>

        
    </div>
</div>

</div>