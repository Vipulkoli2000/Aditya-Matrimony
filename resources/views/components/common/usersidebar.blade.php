<!-- Sidebar Component - No DOCTYPE, HTML, HEAD tags as this is a component -->
<!-- These will be removed as they cause conflicts with parent templates -->
<style>
  /* Sidebar core styles - fixed width to prevent horizontal movement */
  #profile-sidebar {
    position: -webkit-sticky; /* For Safari */
    position: sticky !important;
    top: 85px !important; /* Offset from the top of the viewport, below the fixed navbar */
    align-self: flex-start; /* Aligns item to the start of the flex container (Bootstrap column) */
    
    width: 280px !important; /* Fixed width */
    min-width: 280px !important; /* Prevent shrinking */
    max-width: 280px !important; /* Prevent expanding */
    
    /* Set a max-height to ensure sidebar content scrolls if it's too long for the viewport */
    /* 100vh (viewport height) - 85px (top offset) - 20px (bottom buffer) */
    max-height: calc(100vh - 85px - 20px) !important; 
    
    background-color: white;
    overflow-y: auto; /* Enable internal scrolling for the sidebar if content overflows max-height */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-left: 1px solid #eee;
    border-radius: 8px;
    margin: 0 !important; /* Remove any margin */
  }

  /* Sidebar toggle button */
  #profile-sidebar-toggle {
    position: fixed !important;
    top: 85px !important;
    right: 15px !important;
    z-index: 9999 !important; 
    display: none; /* Hidden by default on desktop */
    background-color: #ff3e3e;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }
  
  #profile-sidebar-toggle:hover {
    background-color: #e53030;
  }
  
  #profile-sidebar-toggle .bar {
    display: block;
    width: 24px;
    height: 2px;
    margin: 3px 0;
    background-color: white;
    border-radius: 1px;
  }

  /* Responsive adjustments */
  @media (max-width: 992px) {
    /* Mobile styles */
    #profile-sidebar {
      transform: translateX(100%); /* Off-screen by default */
      width: 280px !important;
    }
    
    #profile-sidebar.active {
      transform: translateX(0); /* Slide in when active */
    }
    
    #profile-sidebar-toggle {
      display: flex !important; /* Show toggle on mobile */
    }
    
    .main-content {
      width: 100% !important;
      margin-right: 0 !important;
    }
  }
  
  @media (min-width: 993px) {
    /* Desktop styles */
    #profile-sidebar {
      transform: translateX(0) !important; /* Always visible */
    }
    
    #profile-sidebar-toggle {
      display: none !important; /* Hide toggle on desktop */
    }
    
    .main-content {
      width: calc(100% - 280px) !important;
      margin-right: 280px !important;
    }
  }

  /* Header styling with reduced padding */
  .profile-sidebar-header {
    background: linear-gradient(to right, #60B5FF, #8FC4E0);
    color: white;
    padding: 10px 15px; /* Reduced from 15px 20px */
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid rgba(0,0,0,0.1);
  }
  
  .profile-sidebar-title {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 0.5px;
  }
  
  .profile-sidebar-close {
    background: transparent;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* Navigation list styling with reduced spacing */
  .profile-sidebar-nav {
    list-style: none;
    padding: 8px 10px; /* Reduced padding from 15px to 8px */
    margin: 0;
  }
  
  .profile-sidebar-item {
    border-radius: 6px;
    margin-bottom: 4px; /* Reduced from 8px to 4px */
    transition: all 0.2s ease;
    border: none;
    overflow: hidden;
  }
  
  .profile-sidebar-item a {
    text-decoration: none;
    color: #333;
    display: block;
    padding: 8px 16px; /* Reduced from 12px to 8px */
    font-weight: 500;
    border-left: 3px solid transparent;
    transition: all 0.2s ease;
    line-height: 1.2; /* Tighter line height */
    font-size: 0.95rem; /* Slightly smaller font size */
  }
  
  .profile-sidebar-item:hover {
    background-color: rgba(96, 181, 255, 0.1);
    transform: translateX(3px);
  }
  
  .profile-sidebar-item:hover a {
    color: #4A9FE0;
    border-left-color: #4A9FE0;
  }
  
  .profile-sidebar-item.active {
    background-color: #60B5FF !important;
    box-shadow: 0 3px 8px rgba(74, 159, 224, 0.2);
  }
  
  .profile-sidebar-item.active a {
    color: white !important;
    border-left-color: white;
    font-weight: 600;
  }
</style>
<!-- Mobile Toggle Button for Sidebar -->  
<button id="profile-sidebar-toggle" aria-label="Toggle Navigation Menu">
  <span class="bar"></span>
  <span class="bar"></span>
  <span class="bar"></span>
</button>

<!-- Consistent Profile Sidebar -->  
<div id="profile-sidebar">
  <div class="profile-sidebar-header">
    <h5 class="profile-sidebar-title">Profile Dashboard</h5>
    <button id="profile-sidebar-close" class="profile-sidebar-close d-lg-none">&times;</button>
  </div>
  <div class="profile-sidebar-body">
    <ul class="profile-sidebar-nav">
          <!-- Example list items -->
      <li class="profile-sidebar-item {{ request()->routeIs('search.create') ? 'active' : '' }}">
        <a href="{{ route('search.create') }}">
          Search
        </a>
      </li>
          <li class="profile-sidebar-item {{ request()->routeIs('view_profile.create') ? 'active' : '' }}">
            <a href="{{ route('view_profile.create') }}">
              View Profile
            </a>
          </li>
      <li class="profile-sidebar-item {{ request()->routeIs('basic_details.index') ? 'active' : '' }}">
        <a href="{{ route('basic_details.index') }}">
          Basic Details
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('religious_details.create') ? 'active' : '' }}">
        <a href="{{ route('religious_details.create') }}">
          Religious Details
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('family_details.create') ? 'active' : '' }}">
        <a href="{{ route('family_details.create') }}">
          Family Details
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('astronomy_details.create') ? 'active' : '' }}">
        <a href="{{ route('astronomy_details.create') }}">
          Astronomy Details
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('educational_details.create') ? 'active' : '' }}">
        <a href="{{ route('educational_details.create') }}">
          Educational Details
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('occupation_details.create') ? 'active' : '' }}">
        <a href="{{ route('occupation_details.create') }}">
          Occupational Details
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('contact_details.create') ? 'active' : '' }}">
        <a href="{{ route('contact_details.create') }}">
          Contact Details
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('life_partner.create') ? 'active' : '' }}">
        <a href="{{ route('life_partner.create') }}">
          About Life Partner
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('user_packages.create') ? 'active' : '' }}">
        <a href="{{ route('user_packages.create') }}">
          Buy Packages
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('profiles.view_interested') ? 'active' : '' }}">
        <a href="{{ route('profiles.view_interested') }}">
          Interested
        </a>
      </li>
      <li class="profile-sidebar-item {{ request()->routeIs('profiles.view_favorite') ? 'active' : '' }}">
        <a href="{{ route('profiles.view_favorite') }}">
          Favorites
        </a>
      </li>
    </ul>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById("profile-sidebar-toggle");
    const sidebar = document.getElementById("profile-sidebar");
    const sidebarClose = document.getElementById("profile-sidebar-close");

    // Toggle sidebar on mobile
    if (sidebarToggle) {
      sidebarToggle.addEventListener("click", function(event) {
        event.stopPropagation();
        sidebar.classList.toggle("active");
        
        // Animate toggle button
        const bars = this.querySelectorAll(".bar");
        if (sidebar.classList.contains("active")) {
          this.style.opacity = "0.7";
          bars[0].style.transform = "rotate(45deg) translate(5px, 5px)";
          bars[1].style.opacity = "0";
          bars[2].style.transform = "rotate(-45deg) translate(5px, -5px)";
        } else {
          this.style.opacity = "1";
          bars.forEach(bar => {
            bar.style.transform = "";
            bar.style.opacity = "1";
          });
        }
      });
    }

    // Close button functionality
    if (sidebarClose) {
      sidebarClose.addEventListener("click", function() {
        sidebar.classList.remove("active");
        if (sidebarToggle) {
          sidebarToggle.style.opacity = "1";
          const bars = sidebarToggle.querySelectorAll(".bar");
          bars.forEach(bar => {
            bar.style.transform = "";
            bar.style.opacity = "1";
          });
        }
      });
    }

    // Close when clicking outside on mobile
    document.addEventListener("click", function(event) {
      if (window.innerWidth < 993 && 
          sidebar.classList.contains("active") && 
          !sidebar.contains(event.target) && 
          event.target !== sidebarToggle) {
        sidebar.classList.remove("active");
        if (sidebarToggle) {
          sidebarToggle.style.opacity = "1";
          const bars = sidebarToggle.querySelectorAll(".bar");
          bars.forEach(bar => {
            bar.style.transform = "";
            bar.style.opacity = "1";
          });
        }
      }
    });
    
    // Initialize sidebar visibility based on screen size
    function initSidebar() {
      if (window.innerWidth >= 993) {
        sidebar.classList.remove("active");
        if (sidebarToggle) {
          const bars = sidebarToggle.querySelectorAll(".bar");
          bars.forEach(bar => {
            bar.style.transform = "";
            bar.style.opacity = "1";
          });
        }
      }
    }
    
    // Set initial state and listen for resize
    initSidebar();
    window.addEventListener('resize', initSidebar);
  });
</script>
