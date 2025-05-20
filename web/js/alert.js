function borrarUsuario(id) {
  const seguro = confirm("¿Seguro que quieres eliminar este usuario?");
  if (seguro) {
    fetch(`index.php?order=deleteU&id=${id}`, {
      method: "GET"
    })
    .then(response => response.text())
    .then(data => {
      alert("usuario eliminado correctamente");
      window.location.reload(); 
    })
    .catch(error => {
      console.error(error);
      alert("Hubo un error al eliminar el usuario.");
    });
  }
}


function borrarPlato(id) {
  const seguro = confirm("¿Seguro que quieres eliminar este Plato?");
  if (seguro) {
    fetch(`index.php?order=deleteD&id=${id}`, {
      method: "GET"
    })
    .then(response => response.text())
    .then(data => {
      alert("plato eliminado correctamente");
      window.location.reload(); 
    })
    .catch(error => {
      console.error(error);
      alert("Hubo un error al eliminar el plato.");
    });
  }
}


function borrarOrden(id) {
  const seguro = confirm("¿Seguro que quieres eliminar este orden?");
  if (seguro) {
    fetch(`index.php?order=deleteO&id=${id}`, {
      method: "GET"
    })
    .then(response => response.text())
    .then(data => {
      alert("Orden eliminado correctamente");
      window.location.reload(); 
    })
    .catch(error => {
      console.error(error);
      alert("Hubo un error al eliminar la Orden.");
    });
  }
}