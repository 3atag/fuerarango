<div class="contenedor-views">

    <div class="row ">

        <div class="col-6 botonera-agregar">
            <a href="practicas/nueva">
            <i class="fas fa-plus-circle fa-2x"></i>
            </a>
        </div>


    </div>

    <div class="row">
        <div class="col">
      

            <table class="table">

                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Límite diario</th>
                        <th>Límite mensual</th>
                        <th>Límite anual</th>
                        <th></th>
                    </tr>

                </thead>


                <?php while ($practica = $practicas->fetch_object()) :
                    
                    if($practica->cantMaxDiaria == 0) {
                        $practica->cantMaxDiaria = 'No Aplica';
                    }

                    if($practica->cantMaxMen == 0) {
                        $practica->cantMaxMen = 'No Aplica';
                    }

                    if($practica->cantMaxAnu == 0) {
                        $practica->cantMaxAnu = 'No Aplica';
                    }


                    ?>

                    <tr>
                        <td><?php echo $practica->codigo ?></td>
                        <td><?php echo $practica->descripcion ?></td>
                        <td><?php echo $practica->cantMaxDiaria ?></td>
                        <td><?php echo $practica->cantMaxMen ?></td>
                        <td><?php echo $practica->cantMaxAnu ?></td>
                        <td><button type="button" class="btn btn-success btn-sm">Exclusiones</button>
                            <button type="button" class="btn btn-primary btn-sm" ><i class="fas fa-pen"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>

                <?php endwhile ?>

            </table>
        </div>

        
    </div>

    <div class="form-row botonera-comun">
            <div class="col">
               
                <a href="/fuerarango"><button type="button" class="btn btn-secondary btn-sm">Volver</button></a>
            </div>
        </div>

</div>