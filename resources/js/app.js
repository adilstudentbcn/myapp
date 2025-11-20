import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

import "../css/app.css";

Alpine.start();

import.meta.glob(["../images/**"]);
