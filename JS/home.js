function manageDashboardNav(n) {
  console.log("blah");
  for (let i = 0; i < 7; i++) {
    if (i == n - 1) {
      document
        .getElementById("daschboardNav" + (i + 1))
        .classList.add("activeDaschboardTypeTool");
      document.getElementById("dashboardTool" + (i + 1)).style.display =
        "block";
      if (n == 1) {
        document
          .getElementById("daschboardNavType1")
          .classList.remove("activeDaschboardTool");
        document
          .getElementById("daschboardNavType2")
          .classList.remove("activeDaschboardTool");
        document
          .getElementById("daschboardNav" + (i + 1))
          .classList.remove("activeDaschboardTypeTool");
        document
          .getElementById("daschboardNav" + (i + 1))
          .classList.add("activeDaschboardTool");
      }
      if (n <= 5 && n >= 2) {
        document
          .getElementById("daschboardNavType1")
          .classList.add("activeDaschboardTool");
        document
          .getElementById("daschboardNavType2")
          .classList.remove("activeDaschboardTool");
        document
          .getElementById("daschboardNav1")
          .classList.remove("activeDaschboardTool");
      }
      if (n == 6 || n == 7) {
        document
          .getElementById("daschboardNavType2")
          .classList.add("activeDaschboardTool");
        document
          .getElementById("daschboardNavType1")
          .classList.remove("activeDaschboardTool");
        document
          .getElementById("daschboardNav1")
          .classList.remove("activeDaschboardTool");
      }
    } else {
      document
        .getElementById("daschboardNav" + (i + 1))
        .classList.remove("activeDaschboardTypeTool");
      document.getElementById("dashboardTool" + (i + 1)).style.display = "none";
    }
  }
}

function showListsConfig(toShow, toHide) {
  document.getElementById(toHide).style.display = "none";
  document.getElementById(toShow).style.display = "block";
}

function chooseNotesPer(n) {
  if (!n.checked) {
    document
      .getElementById("choiceNotesPer1")
      .classList.remove("inactiveNotesPerChoice");
    document
      .getElementById("choiceNotesPer2")
      .classList.add("inactiveNotesPerChoice");
    document
      .getElementById("choiceNotesPer2")
      .classList.remove("activeNotesPerChoice");
    document
      .getElementById("choiceNotesPer1")
      .classList.add("activeNotesPerChoice");
    document.getElementById("choosemodulesToshowNoteDiv").style.display =
      "none";
    document.getElementById("chooseStudentToshowNoteDiv").style.display =
      "block";
    document.getElementById("notesPerModules").style.display = "none";
    document.getElementById("notesPerStudents").style.display = "block";
  } else {
    document
      .getElementById("choiceNotesPer2")
      .classList.remove("inactiveNotesPerChoice");
    document
      .getElementById("choiceNotesPer1")
      .classList.add("inactiveNotesPerChoice");
    document
      .getElementById("choiceNotesPer1")
      .classList.remove("activeNotesPerChoice");
    document
      .getElementById("choiceNotesPer2")
      .classList.add("activeNotesPerChoice");
    document.getElementById("choosemodulesToshowNoteDiv").style.display =
      "block";
    document.getElementById("chooseStudentToshowNoteDiv").style.display =
      "none";
    document.getElementById("notesPerModules").style.display = "block";
    document.getElementById("notesPerStudents").style.display = "none";
  }
}

function detectFileName(n, m) {
  let fileName = n.value;
  document.getElementById(m).innerHTML = fileName;
}
