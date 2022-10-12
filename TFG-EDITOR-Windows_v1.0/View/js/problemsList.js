let toDeleteProblem;

$(document).ready(function () {
    $('#delete_problem_modal').on('show.bs.modal', function (e) {
        let invoker = $(e.relatedTarget);
        toDeleteProblem = parseInt(invoker.closest('.card').attr('id'));
    });

    $('.change_visibility').on('click', function () {
        let image = $(this).children('img').attr('src');
        // Find in the shown image name if it's visible or not and toggle it
        let newVisibility = image.search('not-visible') === -1? 'Private': 'Public';
        let problemId = $(this).closest('.card').attr('id');
        $.ajax({
            url: "/Model/changeVisibility.php",
            method: "POST",
            data: {
                problemId: parseInt(problemId),
                newVisibility: newVisibility,
            },
            success: function () {
                location.reload();
            }
        })
    });
})

function deleteProblem() {
    $.ajax({
        url: "/Model/problemDelete.php",
        method: "POST",
        data: {
            id: toDeleteProblem,
        },
        success: function () {
            location.reload();
        }
    })
}
