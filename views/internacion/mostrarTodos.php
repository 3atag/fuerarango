<div class="row agregar_internacion">

    <div class="col">
   <a href=""><h1>+<span>Agregar internacion</span></h1></a> <p class="hola">hola</p>
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