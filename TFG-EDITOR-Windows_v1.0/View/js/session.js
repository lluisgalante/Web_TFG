let toCloneSession;
let alreadyCalled = 0;

$(document).ready(function () {
    $('form').one('submit', function () {
        let name = document.getElementById("name").value;
        let problems = document.getElementById("multiple-checkboxes");
        problems = $(problems).val();
        let error = document.getElementById("error_msg");

        if (name === "" || problems.length === 0) {
            error.classList.remove('hide');
            error.innerHTML = "Hi ha camps buits.";
            return false;
        }

        // Add the subject field to the form
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        let subjectId = urlParams.get('subject');

        $("<input />").attr("type", "hidden")
            .attr("name", "subject")
            .attr("value", subjectId)
            .appendTo(this);
        return true;
    });

    $('#duplicate_session_modal').on('show.bs.modal', function (e) {
        let invoker = $(e.relatedTarget);
        toCloneSession = parseInt(invoker.closest('.card').attr('id'));
    });
})

function deleteSession(sessionId) {
    $.ajax({
        url: "/Controller/sessionDelete.php",
        method: "POST",
        data: {
            session_id: sessionId,
        },
        success: function () {
            location.reload();
        }
    })
}

function duplicateSession() {
    if (alreadyCalled === 1) {
        return;
    }
    alreadyCalled = 1;
    let session_name = document.getElementById("new_session_name").value;
    if (session_name !== "") {
        $.ajax({
            url: "/Controller/sessionDuplicate.php",
            method: "POST",
            data: {
                session_name: session_name,
                session_id: toCloneSession,
            },
            success: function () {
                location.reload();
            },
        })
    }
}
