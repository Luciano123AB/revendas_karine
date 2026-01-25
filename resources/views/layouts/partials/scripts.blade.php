<script>
    document.addEventListener("DOMContentLoaded", function () {
        Inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999"],
            keepStatic: true
        }).mask("#phone");

        document.getElementById("form").addEventListener("submit", function () {

            let phone = document.getElementById("phone");
            
            phone.value = phone.value.replace(/\D/g, "");
        });
    });

    function limparCampos() {
        document.getElementById("formulario").reset();
    }
</script>
