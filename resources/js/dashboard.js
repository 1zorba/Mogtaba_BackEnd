document.addEventListener("DOMContentLoaded",()=>{


const sidebar =
document.getElementById("sidebar");


const button =
document.getElementById("sidebarToggle");



if(button){

button.addEventListener("click",()=>{

sidebar.classList.toggle("collapsed");

});

}



const openProfileModal =
document.getElementById('openProfileModal');


const closeProfileModal =
document.getElementById('closeProfileModal');


const profileModal =
document.getElementById('profileModal');



if(openProfileModal){

openProfileModal.onclick = ()=>{

profileModal.classList.add('active');

}

}




if(closeProfileModal){

closeProfileModal.onclick = ()=>{

profileModal.classList.remove('active');

}

}



window.onclick = (e)=>{


if(e.target === profileModal){

profileModal.classList.remove('active');

}


}
})


document.addEventListener("DOMContentLoaded", () => {
    // === 1. التحكم بفتح وإغلاق السايدبار وانزياح الصفحة ===
    const dashboardWrapper = document.getElementById("dashboardWrapper");
    const sidebarToggle = document.getElementById("sidebarToggle");

    if (sidebarToggle && dashboardWrapper) {
        sidebarToggle.addEventListener("click", () => {
            dashboardWrapper.classList.toggle("sidebar-collapsed");
        });
    }

    // === 2. التحكم في نافذة تعديل البروفايل (Modal) ===
    const openProfileModal = document.getElementById('openProfileModal');
    const closeProfileModal = document.getElementById('closeProfileModal');
    const profileModal = document.getElementById('profileModal');

    if (openProfileModal && profileModal) {
        openProfileModal.onclick = (e) => {
            e.preventDefault();
            profileModal.classList.add('active');
        };
    }

    if (closeProfileModal && profileModal) {
        closeProfileModal.onclick = () => {
            profileModal.classList.remove('active');
        };
    }

    // إغلاق النافذة عند الضغط خارجها
    window.addEventListener('click', (e) => {
        if (e.target === profileModal) {
            profileModal.classList.remove('active');
        }
    });
});