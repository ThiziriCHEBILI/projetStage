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
    image_poster: "/imagePoster.png",
    seasonCount: 0,
    bestQuality: "4K HDR",
    award: "award winner",
  },
  {
    id: 2,
    title: "Oppenheimer",
    description:
      "L'histoire du physicien J. Robert Oppenheimer et de son rôle dans le développement de la bombe atomique.",
    release_date: "2023-07-19T00:00:00+00:00",
    type_show: "drame",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
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
    image_poster: "/imagePoster.png",
    seasonCount: 1,
    bestQuality: "4K HDR",
    award: "award winner",
  },
  {
    id: 4,
    title: "Squid Game",
    description:
      "Des centaines de joueurs endettés s'affrontent dans des jeux d'enfants mortels pour un énorme prix en argent.",
    release_date: "2021-09-17T00:00:00+00:00",
    type_show: "thriller",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
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
    image_poster: "/imagePoster.png",
    seasonCount: 0,
    bestQuality: "Full HD",
    award: "award winner",
  },
  {
    id: 6,
    title: "Vaïana 2",
    description:
      "Vaïana part pour un nouveau voyage à travers les mers du Pacifique après avoir reçu un appel inattendu de ses ancêtres.",
    release_date: "2024-11-27T00:00:00+00:00",
    type_show: "aventure",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
    seasonCount: 0,
    bestQuality: "4K HDR",
  },
  {
    id: 7,
    title: "Stranger Things",
    description:
      "Dans une petite ville de l'Indiana, la disparition d'un enfant révèle un monde parallèle.",
    release_date: "2016-07-15T00:00:00+00:00",
    type_show: "fantastique",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
    seasonCount: 4,
    bestQuality: "4K HDR",
  },
  {
    id: 8,
    title: "La Casa de Papel",
    description:
      "Un génie du crime orchestre le plus grand braquage de l'histoire de l'Espagne.",
    release_date: "2017-05-02T00:00:00+00:00",
    type_show: "thriller",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
    seasonCount: 5,
    bestQuality: "Full HD",
  },
  {
    id: 9,
    title: "Interstellar",
    description:
      "Des explorateurs traversent un trou de ver pour trouver une nouvelle terre habitable.",
    release_date: "2014-11-05T00:00:00+00:00",
    type_show: "sci-fi",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
    seasonCount: 0,
    bestQuality: "4K HDR",
  },
  {
    id: 10,
    title: "Lupin",
    description:
      "Inspiré par Arsène Lupin, Assane Diop venge son père victime d'une injustice.",
    release_date: "2021-01-08T00:00:00+00:00",
    type_show: "policier",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
    seasonCount: 3,
    bestQuality: "4K HDR",
  },
  {
    id: 11,
    title: "Inception",
    description:
      "Un voleur s'infiltre dans les rêves pour y dérober des secrets.",
    release_date: "2010-07-21T00:00:00+00:00",
    type_show: "sci-fi",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
    seasonCount: 0,
    bestQuality: "Full HD",
  },
  {
    id: 12,
    title: "Arcane",
    description:
      "Deux sœurs se retrouvent dans des camps opposés d'une guerre entre deux cités.",
    release_date: "2021-11-06T00:00:00+00:00",
    type_show: "animation",
    image_show: "/imageVideo.png",
    image_poster: "/imagePoster.png",
    seasonCount: 2,
    bestQuality: "4K HDR",
  },
];

export const trendingSection: Section = {
  title: "Tendances actuelles",
  desc: "Les titres les plus regardés cette semaine en France",
  seeAll: "/shows/tendances",
  withQuality: true,
  info: "type_show",
  shows: [shows[0], shows[1], shows[2], shows[3], shows[4], shows[5], shows[6], shows[7], shows[8], shows[9], shows[10], shows[11], ],
};

export const seriesSection: Section = {
  title: "Séries à dévorer",
  desc: "Saisons complètes, nouveaux épisodes chaque vendredi",
  seeAll: "/shows/series",
  withQuality: true,
  info: "saison",
    shows: [shows[2], shows[3], shows[6], shows[7], shows[9], shows[11]],
};

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
    {
    show: shows[6],
    video: {
      id: 4,
      descriptionVideo: "Épisode 3 de la saison 2",
      image: "/imageVideo.png",
      episodeNumber: 3,
      saisonNumber: 2,
      videoQuality: "4K HDR",
      duration: "00:52:00",
    },
    remainingDuration: "00:18:00",
  },
  {
    show: shows[7],
    video: {
      id: 5,
      descriptionVideo: "Épisode 1 de la saison 3",
      image: "/imageVideo.png",
      episodeNumber: 1,
      saisonNumber: 3,
      videoQuality: "Full HD",
      duration: "00:48:00",
    },
    remainingDuration: "00:36:00",
  },
  {
    show: shows[9],
    video: {
      id: 6,
      descriptionVideo: "Épisode 5 de la saison 1",
      image: "/imageVideo.png",
      episodeNumber: 5,
      saisonNumber: 1,
      videoQuality: "4K HDR",
      duration: "00:45:00",
      },
    remainingDuration: "00:09:00",
  },
];
export const topShows: Show[] = [
  shows[2],
  shows[0],
  shows[4],
  shows[1],
  shows[3],
];
export const heroShows: Show[] = [shows[0], shows[2], shows[4]];
