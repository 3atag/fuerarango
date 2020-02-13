<div class="contenedor-views">
    <h4>Agregar Práctica</h4>

    <form action="save" method="post">

        <div class="form-row">
            <div class="col-2">
                <label for="nombre">Codigo <span>*</span></label>
                <input type="text" name="codigo" id="codigo" class="form-control" maxlength="6" required>
            </div>

            <div class="col-10">
                <label for="beneficio">Descripcion <span>*</span></label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            </div>

        </div>

        <div class="form-row">

            <div class="col">
                <label for="dni">Límite diario <span>*</span></label>
                <input type="number" name="cantMaxDiaria" id="cantMaxDiaria" class="form-control" required>
            </div>

            <div class="col">
                <label for="dni">Límite mensual <span>*</span></label>
                <input type="number" name="cantMaxMen" id="cantMaxMen" class="form-control" required>
            </div>


            <div class="col">
                <label for="dni">Límite anual <span>*</span></label>
                <input type="number" name="cantMaxAnu" id="cantMaxAnu" class="form-control">
            </div>


        </div>

        <div class="form-row">
            <small id="passwordHelpBlock" class="form-text text-muted">
                En los casos en que correspoonda la opcion NO APLICA setear el numero 0.
            </small>
        </div>

        <div class="form-row botonera-comun">
            <div class="col">
                <input type="submit" value="Agregar" class="btn btn-primary btn-sm">

                <a href="/fuerarango/practicas"><button type="button" class="btn btn-secondary btn-sm">Cancelar</button></a>
            </div>
        </div>

    </form>
</div>