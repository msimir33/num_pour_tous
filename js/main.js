"use strict";

/*SIMULATEUR ELIGIBILTE*/

import { button, displayPopup } from "./taxincome.js";

const main = () => {
    button.addEventListener("click", displayPopup);
}

addEventListener("load", main);