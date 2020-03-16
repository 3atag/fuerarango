

<div class="contenedor-views">
<?php if (isset($edit) && isset($pra) && is_object($pra)): 
    
    $url_action = "save?id=$pra->idPractica";
    $btn_value = "Actualizar";
    $campoId = '<input type="hidden" name="iD" id="iD" value="1">';


    ?>

    <h4>Editar Práctica</h4>

<?php else: 
    
    $url_action = "save";
    $btn_value = "Agregar";
    $campoId = '';
    
    ?>

    <h4>Agregar Práctica</h4>    

<?php endif; ?>

 

    <form action=<?php echo $url_action;?> method="post" id="editarPractica">

           

        <div class="form-row">
            
            <div class="col-2">
            <?php echo $campoId; ?> 
                <label for="nombre">Codigo <span>*</span></label>
                <input type="text" name="codigo" id="codigo" value="<?=isset($pra) && is_object($pra) ? $pra->codigo : ''; ?>" class="form-control" maxlength="6" required>
            </div>

            <div class="col-10">
                <label for="beneficio">Descripcion <span>*</span></label>
                <input type="text" name="descripcion" id="descripcion" value="<?=isset($pra) && is_object($pra) ? $pra->descripcion : ''; ?>" class="form-control">
            </div>

        </div>

        <div class="form-row">

            <div class="col">
                <label for="dni">Límite diario <span>*</span></label>
                <input type="number" name="cantMaxDiaria" id="cantMaxDiaria" value="<?=isset($pra) && is_object($pra) ? $pra->cantMaxDiaria : ''; ?>" class="form-control" required>
            </div>

            <div class="col">
                <label for="dni">Límite mensual <span>*</span></label>
                <input type="number" name="cantMaxMen" id="cantMaxMen" value="<?=isset($pra) && is_object($pra) ? $pra->cantMaxMen : ''; ?>" class="form-control" required>
            </div>


            <div class="col">
                <label for="dni">Límite anual <span>*</span></label>
                <input type="number" name="cantMaxAnu" id="cantMaxAnu" value="<?=isset($pra) && is_object($pra) ? $pra->cantMaxAnu : ''; ?>" class="form-control">
            </div>


        </div>

        <div class="form-row">
            <small id="passwordHelpBlock" class="form-text text-muted">
                En los casos en que correspoonda la opcion NO APLICA setear el numero 0.
            </small>
        </div>

        <div class="form-row botonera-comun">
            <div class="col">

                <input type="submit" value=<?php echo $btn_value; ?> class="btn btn-primary btn-sm">

                <a href="/fuerarango/practicas"><button type="button" class="btn btn-secondary btn-sm">Cancelar</button></a>
            </div>
        </div>

    </form>
</div>