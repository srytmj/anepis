<script>
    document.addEventListener("DOMContentLoaded", () => {

        const container = document.getElementById("scheduleContainer");
        const addBtn = document.getElementById("addScheduleBtn");
        const template = document.getElementById("scheduleTemplate");

        addBtn.addEventListener("click", () => {
            container.appendChild(template.content.cloneNode(true));
        });

        container.addEventListener("click", function(e) {
            if (e.target.classList.contains("removeScheduleBtn")) {
                e.target.closest(".schedule-item").remove();
            }
        });

    });
</script>