// Variables para los elementos
const button = document.querySelector('.whatsapp__boton');
const chat = document.querySelector('.whatsapp__chat');
const url = location.pathname;

// Funcion para abrir y cerrar el chat
const toggleWhatsappChat = () => {
  if (chat.classList.contains('whatsapp__boton--activo')) {
    chat.classList.remove('whatsapp__boton--activo');
    button.classList.remove('whatsapp__boton--activo');
    if (chat.classList.contains('wa__lauch')) {
      // Lanzar las animaciones de los customer supports
      setTimeout(() => {
        chat.classList.remove('wa__pending');
        chat.classList.remove('wa__lauch');
      }, 400);
    }
  } else {
    chat.classList.add('wa__pending');
    chat.classList.add('whatsapp__boton--activo');
    button.classList.add('whatsapp__boton--activo');
    if (!chat.classList.contains('wa__lauch')) {
      // Lanzar las animaciones de los customer supports
      setTimeout(() => {
        chat.classList.add('wa__lauch');
      }, 100);
    }
  }
};

// Lanzar el evento al clickear el boton
button.addEventListener('click', toggleWhatsappChat);
