<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        let telefone = document.getElementById("telefone");

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

    document.getElementById("exibir_ocultar").addEventListener("click", function () {

        let botao = document.getElementById("botao");
        let senha = document.getElementById("senha");

        if (senha.type == "password") {
            senha.type = "text";
            botao.classList.remove("bi-eye");
            botao.classList.add("bi-eye-slash");
        } else {
            senha.type = "password";
            botao.classList.remove("bi-eye-slash");
            botao.classList.add("bi-eye");
        }
    })

    document.getElementById("cancelar").addEventListener("click", function () {
        Swal.close();
    })    

    function limparCampos() {
        document.getElementById("formulario").reset();

        let email = document.getElementById("email");
        let telefone = document.getElementById("telefone");

        email.value = "";
        telefone.value = "";
    }
</script>
