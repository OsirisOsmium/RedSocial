<?php
  function accion(){
    echo "accion";
  }
  function acciondos(){
    echo 19;
  }
?>

<input type="submit" name="" value="Buscar" id="boton1" onclick = "funcion();">
<script>
  function funcion(){
    alert('<?php echo accion(); ?>');
    alert(<?php echo acciondos(); ?>);
    /* Escribir en el Documento*/
    document.write('<?php echo accion(); ?>');
    document.write(<?php echo acciondos(); ?>);
  }
</script>