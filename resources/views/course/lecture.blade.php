<script>
    let selectedLecturers = [];

    $("#lecturerSearch").on("input", function() {
        let q = $(this).val().trim();

        if (q.length < 1) {
            $("#lecturerResults").hide();
            return;
        }

        $.ajax({
            url: "/lecturers/search",
            method: "GET",
            data: {
                q: q
            },

            success: function(res) {
                let filtered = res.filter(l => !selectedLecturers.includes(l.id));

                if (filtered.length === 0) {
                    $("#lecturerResults").html(`<div class="text-muted">No results</div>`).show();
                    return;
                }

                let html = filtered.map(l => `
                    <div class="p-1 px-2 lecturer-result-item rounded"
                        style="cursor:pointer;"
                        data-id="${l.id}"
                        data-name="${l.name}">
                        ${l.name}
                    </div>
                `).join("");

                $("#lecturerResults").html(html).show();
            }
        });
    });

    $(document).on("click", ".lecturer-result-item", function() {
        let id = $(this).data("id");
        let name = $(this).data("name");

        selectedLecturers.push(id);

        $("#lecturerSelected").append(`
            <span class="badge bg-primary me-1">
                ${name}
                <button type="button" class="btn-close btn-close-white ms-1 lecturer-remove"
                    data-id="${id}" style="font-size:8px"></button>
            </span>
        `);

        $("#lecturerHidden").append(`
            <input type="hidden" name="lecturers[]" value="${id}" id="lecturer-hidden-${id}">
        `);

        $("#lecturerSearch").val("");
        $("#lecturerResults").hide();
    });

    $(document).on("click", ".lecturer-remove", function() {
        let id = $(this).data("id");
        selectedLecturers = selectedLecturers.filter(x => x != id);

        $(this).parent().remove();
        $("#lecturer-hidden-" + id).remove();
    });
</script>
