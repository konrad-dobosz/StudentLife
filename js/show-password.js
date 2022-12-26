const check = (checkbox) => {
    checkbox.checked ?
        document.querySelectorAll('#pass').forEach((e) => e.setAttribute('type', 'text')) :
        document.querySelectorAll('#pass').forEach((e) => e.setAttribute('type', 'password'));
}