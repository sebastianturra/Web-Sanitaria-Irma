<style>
    .modal-contenido{
  background-color:aqua;
  width:300px;
  padding: 10px 20px;
  margin: 20% auto;
  position: relative;
}
.modal{
  background-color: rgba(0,0,0,.8);
  position:fixed;
  top:0;
  right:0;
  bottom:0;
  left:0;
  opacity:0;
  pointer-events:none;
  transition: all 1s;
}
#miModal:target{
  opacity:1;
  pointer-events:auto;
}
    </style>
    
    <a href="#miModal">Abrir Modal</a>
<div id="miModal" class="modal">
  <div class="modal-contenido">
    <a href="#">X</a>
    <h2>Mi primer Modal</h2>
    <p>Este es mi primera ventana modal sin utilizar JavaScript.</p>
  </div>  
</div>      