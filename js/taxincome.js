/*MES VARIABLES*/

const input = document.getElementById("year-salary");
const eligible = document.querySelector(".eligible");
const notEligible = document.querySelector(".not-eligible");
export const button = document.getElementById("valid-input");

export const displayPopup = () => {

    /*EXECUTION DE LA FONCTION PERMETTANT DE RENDRE INVISIBLE TOUS LES POPUPS POUR VIDER LA DIV*/
    putAllPopupDisplayNone();

    if (input.value < 15000) {
        eligible.style.display = "flex";
    } else {
        notEligible.style.display = "flex";
    }

}

/*FONCTION FLECHEE RENDANT INVISIBLE TOUTES LES DIV*/

const putAllPopupDisplayNone = () => {
    eligible.style.display = "none";
    notEligible.style.display = "none";
}