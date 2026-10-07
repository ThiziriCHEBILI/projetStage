import type { Show, Section, Progress } from "../Types";

export const shows: Show[] = [
  {
    id: 1,
    title: "Dune: Deuxième Partie",
    description:
      "Paul Atréides s'unit aux Fremen pour se venger des conspirateurs qui ont détruit sa famille.",
    release_date: "2024-02-28T00:00:00+00:00",
    type_show: "sci-fi",
    image_show: "/imageVideo.png",
    seasonCount: 0,
    bestQuality: "4K HDR",
  },
  {
    id: 2,
    title: "Oppenheimer",
    description:
      "L'histoire du physicien J. Robert Oppenheimer et de son rôle dans le développement de la bombe atomique.",
    release_date: "2023-07-19T00:00:00+00:00",
    type_show: "drame",
    image_show: "/imageVideo.png",
    seasonCount: 0,
    bestQuality: "Full HD",
  },
  {
    id: 3,
    title: "The Last of Us",
    description:
      "Un contrebandier est chargé d'escorter une adolescente à travers une Amérique post-apocalyptique.",
    release_date: "2023-01-15T00:00:00+00:00",
    type_show: "drame",
    image_show: "/imageVideo.png",
    seasonCount: 1,
    bestQuality: "4K HDR",
  },
  {
    id: 4,
    title: "Squid Game",
    description:
      "Des centaines de joueurs endettés s'affrontent dans des jeux d'enfants mortels pour un énorme prix en argent.",
    release_date: "2021-09-17T00:00:00+00:00",
    type_show: "thriller",
    image_show: "/imageVideo.png",
    seasonCount: 2,
    bestQuality: "Full HD",
  },
  {
    id: 5,
    title: "Le Garçon et le Héron",
    description:
      "Un jeune garçon en deuil part à la recherche de sa mère disparue dans un monde fantastique.",
    release_date: "2023-07-14T00:00:00+00:00",
    type_show: "aventure",
    image_show: "/imageVideo.png",
    seasonCount: 0,
    bestQuality: "Full HD",
  },
  {
    id: 6,
    title: "Vaïana 2",
    description:
      "Vaïana part pour un nouveau voyage à travers les mers du Pacifique après avoir reçu un appel inattendu de ses ancêtres.",
    release_date: "2024-11-27T00:00:00+00:00",
    type_show: "aventure",
    image_show: "/imageVideo.png",
    seasonCount: 0,
    bestQuality: "4K HDR",
  },
];

export const sections: Section[] = [
  {
    id: 2,
    title: "Tendances actuelles",
    desc: "Les titres les plus regardés cette semaine en France",
    seeAll: "/shows/tendances",
    withQuality: true,
    info: "type_show",
    shows: [shows[0], shows[1], shows[2]],
  },
  {
    id: 3,
    title: "Top 5 France aujourd'hui",
    shows: [shows[4], shows[5]],
  },
  {
    id: 4,
    title: "Séries à dévorer",
    desc: "Saisons complètes, nouveaux épisodes chaque vendredi",
    seeAll: "/shows/series",
    withQuality: true,
    info: "saison",
    shows: [shows[2], shows[3]],
  },
];

export const progressList: Progress[] = [
  {
    show: shows[0],
    video: {
      id: 1,
      descriptionVideo: "Bande-annonce officielle de Dune: Deuxième Partie",
      image: "/imageVideo.png",
      episodeNumber: 1,
      saisonNumber: 1,
      videoQuality: "4K HDR",
      duration: "02:46:00",
    },
    remainingDuration: "00:32:00",
  },
  {
    show: shows[2],
    video: {
      id: 3,
      descriptionVideo: "The Last of Us - Saison 1, Épisode 3",
      image: "/imageVideo.png",
      episodeNumber: 3,
      saisonNumber: 1,
      videoQuality: "4K HDR",
      duration: "01:16:00",
    },
    remainingDuration: "00:48:00",
  },
  {
    show: shows[4],
    video: {
      id: 5,
      descriptionVideo: "Bande-annonce officielle du Garçon et le Héron",
      image: "/imageVideo.png",
      episodeNumber: 1,
      saisonNumber: 1,
      videoQuality: "Full HD",
      duration: "02:04:00",
    },
    remainingDuration: "00:12:00",
  },
];
