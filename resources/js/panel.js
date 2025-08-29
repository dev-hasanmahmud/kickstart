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

// Theme toggle
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const themeLogo = document.getElementById('themeLogo');
const body = document.body;

function applyTheme(theme) {
  body.classList.remove('light', 'dark');
  body.classList.add(theme);

  if (theme === 'dark') {
    themeIcon.className = 'fas fa-moon text-light';
    themeLogo.src = window.logoDark;
  } else {
    themeIcon.className = 'fas fa-sun text-dark';
    themeLogo.src = window.logoLight;
  }

  localStorage.setItem('theme', theme);
}

const savedTheme = localStorage.getItem('theme') || 'light';
applyTheme(savedTheme);

themeToggle.addEventListener('click', () => {
  const newTheme = body.classList.contains('light') ? 'dark' : 'light';
  applyTheme(newTheme);
});

// Sidebar toggle
function toggleSidebar() {
  const sidebar = $('#sidebar');
  const main = $('#mainContent');

  const isCollapsed = sidebar.hasClass('collapsed');
  const isVisible = sidebar.hasClass('show');

  if (isCollapsed || !isVisible) {
    sidebar.removeClass('collapsed').addClass('show');
    main.removeClass('full');
    localStorage.setItem('sidebarState', 'expanded');
  } else {
    sidebar.addClass('collapsed').removeClass('show');
    main.addClass('full');
    localStorage.setItem('sidebarState', 'collapsed');
  }
}

$(document).ready(function () {
  // Sidebar toggle mobile
  const sidebarState = localStorage.getItem('sidebarState');
  const isMobile = window.innerWidth <= 768;

  if (sidebarState === 'collapsed' || isMobile) {
    $('#sidebar').addClass('collapsed').removeClass('show');
    $('#mainContent').addClass('full');
  } else {
    $('#sidebar').removeClass('collapsed').addClass('show');
    $('#mainContent').removeClass('full');
  }

  if (isMobile) {
    $('.three-dot').hide();
    $('#themeToggle').hide();
  }

  // Toggle submenu and subsubmenu
  $('.has-submenu > a').click(function (e) {
    e.preventDefault();
    const submenu = $(this).next('.submenu, .has-subsubmenu');
    const arrow = $(this).find('.toggle-arrow');
    const parent = $(this).closest('.has-submenu').parent();

    parent.find('.submenu, .has-subsubmenu').not(submenu).slideUp().removeClass('show');
    parent.find('.toggle-arrow').not(arrow).removeClass('fa-chevron-up').addClass('fa-chevron-down');

    submenu.slideToggle().toggleClass('show');
    arrow.toggleClass('fa-chevron-down fa-chevron-up');
  });

  // Profile dropdown toggle
  $('#dropdownMenu').on('click', function (e) {
    e.preventDefault();
    const dropdown = $(this).parent();
    const arrow = $('#profile-arrow');
    dropdown.toggleClass('show');
    arrow.toggleClass('fa-chevron-down fa-chevron-up');
  });

  $(document).on('click', function (e) {
    if (!$(e.target).closest('.dropdown').length) {
      $('.dropdown').removeClass('show');
      $('#profile-arrow').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    }
  });

  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();
});

document.addEventListener('DOMContentLoaded', function () {
  const modalEl = document.getElementById('commonModal');
  if (!modalEl) {
    return;
  }
  
  const myModal = new bootstrap.Modal(modalEl);

  modalEl.addEventListener('hide.bs.modal', () => {
    if (document.activeElement && modalEl.contains(document.activeElement)) {
      document.activeElement.blur();
    }
  });

  window.showModalContent = function(url, modalTitle = 'Details') {
    $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
        if (response.status) {
          $('#commonModalLabel').text(modalTitle);
          $('#commonModal .modal-body').html(response.data);
          myModal.show();
        } else {
          console.error('Failed to load content.');
        }
      },
      error: function() {
        console.error('AJAX error loading modal content.');
      }
    });
  };
});

// Global scope
window.toggleSidebar = toggleSidebar;
