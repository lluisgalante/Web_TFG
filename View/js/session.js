let toCloneSession;
let alreadyCalled = 0;
/*$(document).ready(function () {
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
})*/
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

    ///NUEVO
    $('#delete_problem_modal').on('show.bs.modal', function (e) {
        let invoker = $(e.relatedTarget);
        toDeleteProblem = parseInt(invoker.closest('.card').attr('id'));
    });

    $('.change_visibility').on('click', function () {
        let image = $(this).children('img').attr('src');
        // Find in the shown image name if it's visible or not and toggle it
        console.log( image.search('not-visible'));
        let newVisibility = image.search('not-visible') === -1? 'deactivated': 'activated';
        console.log(newVisibility);
        let sessionId = $(this).closest('.card').attr('id');
        $.ajax({
            url: "/Model/changeSessionStatus.php",
            method: "POST",
            data: {
                sessionId: parseInt(sessionId),
                newVisibility: newVisibility,
            },
            success: function () {
                //console.log("Funciona");
                location.reload();
            }
        })
    })

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
function deleteGroupSessions(class_group){
    console.log("Dentroo");
    $.ajax({
        url: "/Controller/sessionGroupDelete.php",
        method: "POST",
        data: {
            class_group: class_group,
        },
        success: function () {
            //console.log("HA FUNCIONADO");
            //console.log(class_group);
            location.reload();
        }
    })
}
function deleteGroupSessions_2(){
    console.log("Dentro");
    if (alreadyCalled === 1) {
        return;
    }
    alreadyCalled = 1;
    let class_group = document.getElementById("class_group_delete").value;
    console.log(class_group);
    if (class_group !== "") {
        console.log("Dentro IF");
        $.ajax({
            url: "/Controller/sessionGroupDelete.php",
            method: "POST",
            data: {
                class_group: class_group,
            },
            success: function () {
                location.reload();
            },
        })
    }
}


function duplicateSession() {
    if (alreadyCalled === 1) {
        return;
    }
    alreadyCalled = 1;
    let session_name = document.getElementById("new_session_name").value;
    console.log(class_group);
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
