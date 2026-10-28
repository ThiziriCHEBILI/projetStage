import type { CategoryPage } from "../Types/ApiType";

export const showTypes: string[] = [
  "sci-fi",
  "drame",
  "thriller",
  "aventure",
  "action",
  "horreur",
];

export const filmsPage: CategoryPage = {
  name: "films",
  title: "Films",
  desc: "Découvrez notre sélection de films incontournables : des dernières nouveautés aux grands classiques, en passant par la science-fiction, l'action et le thriller. Trouvez votre prochain film préféré en quelques clics.",
};

export const seriesPage: CategoryPage = {
  name: "series",
  title: "Séries",
  desc: "Plongez dans nos séries à dévorer : thrillers haletants, drames intenses et frissons garantis. Un épisode en appelle toujours un autre.",
};

export const animesPage: CategoryPage = {
  name: "dessins-animes",
  title: "Dessins animés",
  desc: "Des aventures pour tous les âges : mondes imaginaires, héros attachants et grands voyages. À regarder seul ou en famille.",
};
