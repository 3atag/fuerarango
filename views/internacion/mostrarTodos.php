
    <div>

        <h4>Listado de internaciones</h4>

        <table>

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

