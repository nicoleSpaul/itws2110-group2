<!DOCTYPE html>
<html>
  <!-- 
    HOMEPAGE
  -->

  <head>
    <meta charset="UTF-8" />
    <meta name="VERA" content="homepage" />
    <link rel="stylesheet" href="styles.css" />

    <title>VERA</title>
  </head>

  <body>
    <div class="bg"></div>
    <div class="top-menu">
      <h1 id="menu-title">
        <a href="index.html" class="unformatted-link">
          <em class="karla">VERA</em>
        </a>
      </h1>
      <div class="top-menu-right">
        <div class="center-menutext-right">
          <a href="aboutData.html" class="unformatted-link"
            ><em class="kantumruy-pro">About the Data</em>
          </a>
        </div>
        <div class="center-menutext-right">
          <a href="team.html" class="unformatted-link"
            ><em class="kantumruy-pro">Team</em>
          </a>
        </div>
        <div class="center-menutext-right">
          <a href="relevantLinks.html" class="unformatted-link"
            ><em class="kantumruy-pro">Relevant Links</em>
          </a>
        </div>
      </div>
    </div>

    <div class="top-menu-holder"></div>

    <!-- Time Slider -->
    <div class="time-slider">
      <label for="dateRange" class="slider-label">Select Date:</label>
      <input
        type="range"
        id="dateRange"
        name="dateRange"
        min="0"
        max="13200"
        value="0"
        step="1"
        class="slider"
      />

      <select id="monthSelect"></select>
      <select id="daySelect"></select>
      <select id="yearSelect"></select>
    </div>

    <div class="content">

      <!-- Map -->
      <div class="message">
        <em>Map here!</em>
      </div>

      <!-- Legend -->
      <div class="legend">
        <h3 class="legend-title"><u>Legend</u></h3>
        <div class="legend-item">
          <div class="color-box" style="background-color: #0000BE;"></div>
          <span>500+ cases</span>
        </div>
        <div class="legend-item">
          <div class="color-box" style="background-color: #3E78FF;"></div>
          <span>100-499 cases</span>
        </div>
        <div class="legend-item">
          <div class="color-box" style="background-color: #C6DBFF;"></div>
          <span>< 99 cases</span>
        </div>
      </div>
    </div>

    <script src="script.js"></script>

    <div id="footer">
      <ul>
        <li class="kantumruy-pro-bold">Contact Us:</li>
        <li class="kantumruy-pro">Nicole Spaulding - spauln@rpi.edu</li>
        <li class="kantumruy-pro">Priscilla Wong - wongp4@rpi.edu</li>
        <li class="kantumruy-pro">Courteney Sit - sitc@rpi.edu</li>
        <li class="kantumruy-pro">Dana Siong Sin - siongd@rpi.edu</li>
      </ul>
      <div id="footer-imgs">
        <img src="images/nasaLogo.png" class="logo-image" alt="NASA logo" />
        <img src="images/rensselaerLogo.png" class="logo-image" alt="RPI logo" />
      </div>
    </div>

  </body>
</html>
