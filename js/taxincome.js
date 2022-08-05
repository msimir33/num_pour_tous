// Mes variables

const input = document.getElementById("year-salary");
const eligible = document.querySelector(".eligible");
const notEligible = document.querySelector(".not-eligible");
export const button = document.getElementById("valid-input");

export const displayPopup = () => {

    // Je mets toutes les popup en display none au cas où il y en ait déjà une visible
    putAllPopupDisplayNone();

    if (input.value < 15000) {
        eligible.style.display = "flex";
    } else {
        notEligible.style.display = "flex";
    }

}

const putAllPopupDisplayNone = () => {
    eligible.style.display = "none";
    notEligible.style.display = "none";
}