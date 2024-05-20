const clickbtn = document.querySelector(".btn");
clickbtn.addEventListener('click', toBedStatus);
function toBedStatus() {
    window.location="http://localhost/EmptyBedOverview/Empty_bed.php";
}