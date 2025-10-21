document.addEventListener("DOMContentLoaded", () => {
  const slider = document.getElementById("dateRange");
  const selectedDate = document.getElementById("selectedDate");

  const startDate = new Date(1987, 0, 1);

  slider.addEventListener("input", function() {
    const newDate = new Date(startDate);
    newDate.setDate(startDate.getDate() + parseInt(this.value));

    // Change Date
    const formatted = newDate.toLocaleDateString("en-US", {
      year: "numeric",
      month: "long",
      day: "numeric"
    });

    selectedDate.textContent = formatted;

    // update map
  });
});
