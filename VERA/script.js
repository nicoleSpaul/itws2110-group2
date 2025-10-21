document.addEventListener("DOMContentLoaded", () => {
  const slider = document.getElementById("dateRange");
  const yearSelect = document.getElementById("yearSelect");
  const monthSelect = document.getElementById("monthSelect");
  const daySelect = document.getElementById("daySelect");

  const startDate = new Date(1987, 0, 1);
  const endDate = new Date(2023, 1, 10);

  const totalDays = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24));
  slider.max = totalDays;

  // Year dropdown
  for (let y = startDate.getFullYear(); y <= endDate.getFullYear(); y++) {
    const option = document.createElement("option");
    option.value = y;
    option.textContent = y;
    yearSelect.appendChild(option);
  }

  // Month dropdown
  const monthNames = [
    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
  ];
  monthNames.forEach((name, i) => {
    const option = document.createElement("option");
    option.value = i;
    option.textContent = name;
    monthSelect.appendChild(option);
  });

  // Day dropdown
  const updateDays = () => {
    const year = parseInt(yearSelect.value);
    const month = parseInt(monthSelect.value);
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    daySelect.innerHTML = "";
    for (let d = 1; d <= daysInMonth; d++) {
      const option = document.createElement("option");
      option.value = d;
      option.textContent = d;
      daySelect.appendChild(option);
    }
  };

  updateDays();

  // Sync slider with dropdowns
  slider.addEventListener("input", function() {
    const newDate = new Date(startDate);
    newDate.setDate(startDate.getDate() + parseInt(this.value));

    yearSelect.value = newDate.getFullYear();
    monthSelect.value = newDate.getMonth();
    updateDays();
    daySelect.value = newDate.getDate();
  });

  // Sync dropdowns with slider
  const updateSliderFromDropdowns = () => {
    const selectedDate = new Date(
      parseInt(yearSelect.value),
      parseInt(monthSelect.value),
      parseInt(daySelect.value)
    );

    if (selectedDate < startDate) selectedDate = startDate;
    if (selectedDate > endDate) selectedDate = endDate;

    const diffDays = Math.floor((selectedDate - startDate) / (1000 * 60 * 60 * 24));
    slider.value = diffDays;
  };

  yearSelect.addEventListener("change", () => { updateDays(); updateSliderFromDropdowns(); });
  monthSelect.addEventListener("change", () => { updateDays(); updateSliderFromDropdowns(); });
  daySelect.addEventListener("change", updateSliderFromDropdowns);

  slider.dispatchEvent(new Event("input"));
});
