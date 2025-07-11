"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const alunoController_1 = require("../controllers/alunoController");
const loginController_1 = require("../controllers/loginController");
const routes = express_1.default.Router();
routes.post("/alunos", alunoController_1.criarAluno);
routes.post("/login", loginController_1.login);
exports.default = routes;
