<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        let telefone = document.getElementById("phone");

        let im = new Inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999"],
            keepStatic: true,
            clearIncomplete: false
        });

        im.mask(telefone);

        document.getElementById("formulario").addEventListener("submit", function () {
            
            let numeros = telefone.inputmask.unmaskedvalue();

            telefone.value = numeros;
        });
    });

    function limparCampos() {
        document.getElementById("formulario").reset();
    }
</script>
