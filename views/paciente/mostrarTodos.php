<div class="agregar_paciente">

    <div class="row ">

        <div class="col">
            <a href="pacientes/nuevo">
                <h1>+</h1>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col">

            <h4>Padron CPHA</h4>

            <table class="table">

                <?php while ($paciente = $pacientes->fetch_object()) : ?>

                    <tr>
                        <td><?php echo $paciente->beneficio ?></td>
                        <td><?php echo $paciente->nombre ?></td>
                        <td><?php echo $paciente->dni ?></td>
                        <td><?php echo $paciente->activo ?></td>
                    </tr>

                <?php endwhile ?>

            </table>
        </div>
    </div>

</div>