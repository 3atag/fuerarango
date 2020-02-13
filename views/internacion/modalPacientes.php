<div class="modal fade-lg" id="modalAddPaciente" tabindex="-1" role="dialog" aria-labelledby="modalAddPaciente" aria-hidden="true">

    <div class="modal-dialog-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Seleccionar paciente
                </h5>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <input type="text" class="form-control buscador" id="buscador" placeholder="Buscar afiliado">

            <div class="modal-body">

                <table class="table" id="allPacientes">

                    <thead>
                        <tr>
                            <th></th>
                            <th>Beneficio</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                        
                        </tr>
                    </thead>

                    <tbody>

                    <?php while ($paciente = $pacientes->fetch_object()) : 

                    $filaEntera = array($paciente->idPaciente,$paciente->nombre);
                        
                        ?>

                        

                        <tr>
                            <td><button type="button" class="btn btn-primary btn-paciente" value="<?php echo $paciente->idPaciente;?>" name="<?php echo $paciente->nombre;?>">Seleccionar</button></td>                            
                            <td><?php echo $paciente->beneficio ?></td>
                            <td><?php echo $paciente->nombre ?></td>
                            <td><?php echo $paciente->dni ?></td>
              
                        </tr>

                    <?php endwhile ?>

                    </tbody>

                </table>


            </div>
        </div>

    </div>