function chooseProfile(n) {
  switch (n) {
    case 1:
      document.getElementById("profile1").className = "profileChoiceActive";
      document.getElementById("profile2").className = NaN;
      document.getElementById("profile3").className = NaN;
      document.getElementById("adminLogin").style.display = "block";
      document.getElementById("enseignantLogin").style.display = "none";
      document.getElementById("etudiantLogin").style.display = "none";
      break;
    case 2:
      document.getElementById("profile2").className = "profileChoiceActive";
      document.getElementById("profile1").className = NaN;
      document.getElementById("profile3").className = NaN;
      document.getElementById("adminLogin").style.display = "none";
      document.getElementById("enseignantLogin").style.display = "block";
      document.getElementById("etudiantLogin").style.display = "none";
      break;
    case 3:
      document.getElementById("profile3").className = "profileChoiceActive";
      document.getElementById("profile1").className = NaN;
      document.getElementById("profile2").className = NaN;
      document.getElementById("adminLogin").style.display = "none";
      document.getElementById("enseignantLogin").style.display = "none";
      document.getElementById("etudiantLogin").style.display = "block";
      break;
    default:
      break;
  }
}
