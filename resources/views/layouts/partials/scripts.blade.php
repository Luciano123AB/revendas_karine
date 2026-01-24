<script>
    @if(session("") === "")
        //
    @else
        //
    @endif
        
    document.addEventListener("mousemove", (e) => {
        
        const x = (e.clientX / window.innerWidth - 0) * 0;
        const y = (e.clientY / window.innerHeight - 0) * 0;

    });

    document.addEventListener("click", function(e) {
        if(e.target && e.target.id === ""){
            //
        }
    });

    document.addEventListener("change", function(e) {
        if (e.target && e.target.id === "") {
            //
        }
    });

    function limparCampos() {
        //
    }
</script>
