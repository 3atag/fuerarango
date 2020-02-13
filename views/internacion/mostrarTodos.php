<div class="agregar_internacion">

    <div class="row ">

        <div class="col-6">

            <a href="internaciones/nueva">
                <i class="fas fa-plus-square fa-3x"></i>
            </a>
        </div>
        <div class="col botonera">

            <a href="pacientes/nuevo" class="btn btn-secondary">
                <i class="fas fa-user-injured fa-lg"></i>
            </a>

            <a href="practicas" class="btn btn-secondary">
                <i class="fas fa-clinic-medical fa-lg"></i>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <h4>Historial</h4>

            <table class="table">

                <?php while ($internacion = $internaciones->fetch_object()) : ?>

                    <tr>
                        <td><?php echo $internacion->beneficio ?></td>
                        <td><?php echo $internacion->nombre ?></td>
                        <td><?php echo $internacion->fechaIngreso ?></td>
                        <td><?php echo $internacion->fechaEgreso ?></td>
                    </tr>

                <?php endwhile ?>

            </table>
        </div>
    </div>

</div>