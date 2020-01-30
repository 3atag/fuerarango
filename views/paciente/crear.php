<h4>Agregar Paciente</h4>

    <form action="index.php?controller=PacienteController&action=save" method="post">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control">
        </div>

        <div class="form-group">
            <label for="beneficio">Beneficio</label>
            <input type="text" name="beneficio" id="beneficio" class="form-control">
        </div>

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Agregar" class="btn btn-primary">
        </div>

    </form>
