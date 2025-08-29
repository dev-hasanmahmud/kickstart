// Load page
window.addEventListener('load', function () {
  const loader = document.getElementById('page-loader');
  
  if (loader) {
    setTimeout(() => {
      loader.style.opacity = '0';
      setTimeout(() => loader.style.display = 'none', 300);
    }, 1000);
  }
});
