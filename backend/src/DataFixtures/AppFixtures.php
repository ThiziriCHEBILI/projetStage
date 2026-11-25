<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Show;
use App\Entity\CategoriesShow;
use App\Entity\ShowVideo;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categoriesShowData = [
            ["name" => "films"],
            ["name" => "series"],
            ["name" => "dessins-animes"],
        ];

        $categoriesShow = [];
        foreach ($categoriesShowData as $categoryData) {
            $category = new CategoriesShow();
            $category->setName($categoryData["name"]);
            $manager->persist($category);
            $categoriesShow[] = $category;
        }

        $showsData = [
            // Films (categoryIndex => 0)
            ["title" => "Dune: Deuxième Partie", "description" => "Paul Atréides s'unit aux Fremen pour se venger des conspirateurs qui ont détruit sa famille.", "categoryIndex" => 0, "datePublication" => "2026-09-27", "releaseDate" => "2024-02-28", "type_show" => "sci-fi", "image_show" => "dune-deuxieme-partie-h.webp", "image_poster" => "dune-deuxieme-partie-v.webp", "award" => "award winner", "quality" => "4K HDR"],
            ["title" => "Oppenheimer", "description" => "L'histoire du physicien J. Robert Oppenheimer et de son rôle dans le développement de la bombe atomique.", "categoryIndex" => 0, "datePublication" => "2026-09-08", "releaseDate" => "2023-07-19", "type_show" => "drame", "image_show" => "oppenheimer-h.webp", "image_poster" => "oppenheimer-v.webp", "quality" => "Full HD"],
            ["title" => "Interstellar", "description" => "Des explorateurs traversent un trou de ver pour trouver une nouvelle terre habitable.", "categoryIndex" => 0, "datePublication" => "2026-09-03", "releaseDate" => "2014-11-05", "type_show" => "sci-fi", "image_show" => "interstellar-h.webp", "image_poster" => "interstellar-v.webp", "quality" => "4K HDR"],
            ["title" => "Inception", "description" => "Un voleur s'infiltre dans les rêves pour y dérober des secrets.", "categoryIndex" => 0, "datePublication" => "2026-09-05", "releaseDate" => "2010-07-21", "type_show" => "sci-fi", "image_show" => "inception-h.webp", "image_poster" => "inception-v.webp", "quality" => "Full HD"],
            ["title" => "Don't Worry Darling", "description" => "Alice vit dans une communauté idéale des années 50, jusqu'à ce qu'elle découvre ce que cache le projet de son mari.", "categoryIndex" => 0, "datePublication" => "2026-09-20", "releaseDate" => "2022-09-21", "type_show" => "thriller", "image_show" => "dont-worry-darling-h.webp", "image_poster" => "dont-worry-darling-v.webp", "quality" => "4K HDR"],
            ["title" => "Mad Max: Fury Road", "description" => "Dans un désert post-apocalyptique, une guerrière fuit un tyran avec quelques survivantes.", "categoryIndex" => 0, "datePublication" => "2026-09-21", "releaseDate" => "2015-05-14", "type_show" => "action", "image_show" => "mad-max-h.webp", "image_poster" => "mad-max-v.webp", "award" => "award winner", "quality" => "4K HDR"],
            ["title" => "Indiana Jones et le Cadran", "description" => "Indiana Jones part à la recherche d'un cadran légendaire capable de changer le cours de l'Histoire.", "categoryIndex" => 0, "datePublication" => "2026-09-24", "releaseDate" => "2023-06-28", "type_show" => "aventure", "image_show" => "indiana-jones-et-le-cadran-h.webp", "image_poster" => "indiana-jones-et-le-cadran-v.webp", "quality" => "4K HDR"],
            ["title" => "Conjuring", "description" => "Deux enquêteurs du paranormal viennent en aide à une famille terrorisée dans sa ferme.", "categoryIndex" => 0, "datePublication" => "2026-09-14", "releaseDate" => "2013-07-19", "type_show" => "horreur", "image_show" => "conjuring-h.webp", "image_poster" => "conjuring-v.webp", "quality" => "Full HD"],
            ["title" => "Anatomie d'une chute", "description" => "Une écrivaine est jugée pour la mort de son mari, avec son fils malvoyant comme seul témoin.", "categoryIndex" => 0, "datePublication" => "2026-09-22", "releaseDate" => "2023-08-23", "type_show" => "drame", "image_show" => "anatomie-d-une-chute-h.webp", "image_poster" => "anatomie-d-une-chute-v.webp", "award" => "award winner", "quality" => "4K HDR"],
            ["title" => "John Wick", "description" => "Un ancien tueur à gages sort de sa retraite pour venger la mort de son chien.", "categoryIndex" => 0, "datePublication" => "2026-09-29", "releaseDate" => "2014-10-29", "type_show" => "action", "image_show" => "john-wick-h.webp", "image_poster" => "john-wick-v.webp", "quality" => "4K HDR"],

            // Séries (categoryIndex => 1)
            ["title" => "The Last of Us", "description" => "Un contrebandier est chargé d'escorter une adolescente à travers une Amérique post-apocalyptique.", "categoryIndex" => 1, "datePublication" => "2026-09-28", "releaseDate" => "2023-01-15", "type_show" => "drame", "image_show" => "the-last-of-us-h.webp", "image_poster" => "the-last-of-us-v.webp", "award" => "award winner", "season_count" => 2, "quality" => "4K HDR"],
            ["title" => "Squid Game", "description" => "Des centaines de joueurs endettés s'affrontent dans des jeux d'enfants mortels pour un énorme prix en argent.", "categoryIndex" => 1, "datePublication" => "2026-09-25", "releaseDate" => "2021-09-17", "type_show" => "thriller", "image_show" => "squid-game-h.webp", "image_poster" => "squid-game-v.webp", "season_count" => 3, "quality" => "Full HD"],
            ["title" => "Stranger Things", "description" => "Dans une petite ville de l'Indiana, la disparition d'un enfant révèle un monde parallèle.", "categoryIndex" => 1, "datePublication" => "2026-09-12", "releaseDate" => "2016-07-15", "type_show" => "horreur", "image_show" => "stranger-things-h.webp", "image_poster" => "stranger-things-v.webp", "season_count" => 5, "quality" => "4K HDR"],
            ["title" => "La Casa de Papel", "description" => "Un génie du crime orchestre le plus grand braquage de l'histoire de l'Espagne.", "categoryIndex" => 1, "datePublication" => "2026-09-07", "releaseDate" => "2017-05-02", "type_show" => "thriller", "image_show" => "la-casa-de-papel-h.webp", "image_poster" => "la-casa-de-papel-v.webp", "season_count" => 5, "quality" => "Full HD"],
            ["title" => "Lupin", "description" => "Inspiré par Arsène Lupin, Assane Diop venge son père victime d'une injustice.", "categoryIndex" => 1, "datePublication" => "2026-09-16", "releaseDate" => "2021-01-08", "type_show" => "thriller", "image_show" => "lupin-h.webp", "image_poster" => "lupin-v.webp", "season_count" => 4, "quality" => "4K HDR"],
            ["title" => "Dark", "description" => "La disparition d'enfants dans une petite ville allemande révèle un secret de famille.", "categoryIndex" => 1, "datePublication" => "2026-09-06", "releaseDate" => "2017-12-01", "type_show" => "sci-fi", "image_show" => "dark-h.webp", "image_poster" => "dark-v.webp", "season_count" => 3, "quality" => "4K HDR"],
            ["title" => "The Umbrella Academy", "description" => "Sept frères et sœurs aux pouvoirs extraordinaires se réunissent à la mort de leur père et tentent d'empêcher la fin du monde.", "categoryIndex" => 1, "datePublication" => "2026-09-26", "releaseDate" => "2019-02-15", "type_show" => "sci-fi", "image_show" => "the-umbrella-academy-h.webp", "image_poster" => "the-umbrella-academy-v.webp", "season_count" => 4, "quality" => "4K HDR"],
            ["title" => "The Witcher", "description" => "Un chasseur de monstres solitaire croise la route d'une princesse en fuite.", "categoryIndex" => 1, "datePublication" => "2026-09-19", "releaseDate" => "2019-12-20", "type_show" => "aventure", "image_show" => "the-witcher-h.webp", "image_poster" => "the-witcher-v.webp", "season_count" => 4, "quality" => "4K HDR"],
            ["title" => "House of the Dragon", "description" => "Deux siècles avant Game of Thrones, la maison Targaryen se déchire pour le trône de fer.", "categoryIndex" => 1, "datePublication" => "2026-09-18", "releaseDate" => "2022-08-21", "type_show" => "drame", "image_show" => "house-of-the-dragon-h.webp", "image_poster" => "house-of-the-dragon-v.webp", "season_count" => 3, "quality" => "4K HDR"],
            ["title" => "Peaky Blinders", "description" => "Une famille de gangsters étend son pouvoir dans l'Angleterre d'après-guerre.", "categoryIndex" => 1, "datePublication" => "2026-09-10", "releaseDate" => "2013-09-12", "type_show" => "drame", "image_show" => "peaky-blinders-h.webp", "image_poster" => "peaky-blinders-v.webp", "season_count" => 6, "quality" => "Full HD"],

            // Dessins animés (categoryIndex => 2)
            ["title" => "Le Garçon et le Héron", "description" => "Un jeune garçon en deuil part à la recherche de sa mère disparue dans un monde fantastique.", "categoryIndex" => 2, "datePublication" => "2026-09-30", "releaseDate" => "2023-07-14", "type_show" => "aventure", "image_show" => "le-garcon-et-le-heron-h.webp", "image_poster" => "le-garcon-et-le-heron-v.webp", "award" => "award winner", "quality" => "Full HD"],
            ["title" => "Vaïana 2", "description" => "Vaïana part pour un nouveau voyage à travers les mers du Pacifique après avoir reçu un appel inattendu de ses ancêtres.", "categoryIndex" => 2, "datePublication" => "2026-09-23", "releaseDate" => "2024-11-27", "type_show" => "aventure", "image_show" => "vaiana-2-h.webp", "image_poster" => "vaiana-2-v.webp", "quality" => "4K HDR"],
            ["title" => "Arcane", "description" => "Deux sœurs se retrouvent dans des camps opposés d'une guerre entre deux cités.", "categoryIndex" => 2, "datePublication" => "2026-09-15", "releaseDate" => "2021-11-06", "type_show" => "action", "image_show" => "arcane-h.webp", "image_poster" => "arcane-v.webp", "season_count" => 2, "quality" => "4K HDR"],
            ["title" => "Le Voyage de Chihiro", "description" => "Une fillette se retrouve piégée dans un monde d'esprits et doit travailler pour sauver ses parents.", "categoryIndex" => 2, "datePublication" => "2026-09-04", "releaseDate" => "2001-07-20", "type_show" => "aventure", "image_show" => "le-voyage-de-chihiro-h.webp", "image_poster" => "le-voyage-de-chihiro-v.webp", "award" => "award winner", "quality" => "Full HD"],
            ["title" => "Princesse Mononoké", "description" => "Un jeune prince se retrouve au milieu du conflit entre les dieux de la forêt et les humains.", "categoryIndex" => 2, "datePublication" => "2026-09-02", "releaseDate" => "1997-07-12", "type_show" => "aventure", "image_show" => "princesse-mononoke-h.webp", "image_poster" => "princesse-mononoke-v.webp", "quality" => "Full HD"],
            ["title" => "Mon Voisin Totoro", "description" => "Deux sœurs installées à la campagne rencontrent un esprit gardien de la forêt.", "categoryIndex" => 2, "datePublication" => "2026-09-09", "releaseDate" => "1988-04-16", "type_show" => "aventure", "image_show" => "mon-voisin-totoro-h.webp", "image_poster" => "mon-voisin-totoro-v.webp", "quality" => "Full HD"],
            ["title" => "Demon Slayer", "description" => "Un jeune garçon devient pourfendeur de démons pour sauver sa sœur transformée.", "categoryIndex" => 2, "datePublication" => "2026-09-17", "releaseDate" => "2019-04-06", "type_show" => "action", "image_show" => "demon-slayer-h.webp", "image_poster" => "demon-slayer-v.webp", "season_count" => 4, "quality" => "4K HDR"],
            ["title" => "L'Attaque des Titans", "description" => "Des humains réfugiés derrière d'immenses murs luttent contre des géants dévoreurs d'hommes.", "categoryIndex" => 2, "datePublication" => "2026-09-11", "releaseDate" => "2013-04-07", "type_show" => "action", "image_show" => "l-attaque-des-titans-h.webp", "image_poster" => "l-attaque-des-titans-v.webp", "award" => "award winner", "season_count" => 4, "quality" => "4K HDR"],
            ["title" => "Jujutsu Kaisen", "description" => "Un lycéen avale une relique maudite et rejoint une école d'exorcistes.", "categoryIndex" => 2, "datePublication" => "2026-09-13", "releaseDate" => "2020-10-03", "type_show" => "action", "image_show" => "jujutsu-kaisen-h.webp", "image_poster" => "jujutsu-kaisen-v.webp", "season_count" => 3, "quality" => "4K HDR"],
            ["title" => "Spider-Man: New Generation", "description" => "Un adolescent devient Spider-Man et rencontre ses homologues venus d'autres dimensions.", "categoryIndex" => 2, "datePublication" => "2026-10-01", "releaseDate" => "2018-12-12", "type_show" => "action", "image_show" => "spider-man-new-generation-h.webp", "image_poster" => "spider-man-new-generation-v.webp", "quality" => "4K HDR"],
        ];


        $shows = [];
        foreach ($showsData as $showData) {
            $show = new Show();
            $show->setTitle($showData["title"]);
            $show->setDescription($showData["description"]);
            $show->setDatePublication(new \DateTime($showData["datePublication"]));
            $show->setReleaseDate(new \DateTime($showData["releaseDate"]));
            $show->setAward($showData["award"] ?? null);
            $show->setTypeShow($showData["type_show"] ?? null);
            $show->setImageShow($showData["image_show"]);
            $show->setImagePoster($showData["image_poster"]);
            $show->setSeasonCount($showData["season_count"] ?? null);
            $show->setQuality($showData["quality"]);
            $show->setCategoryShow($categoriesShow[$showData["categoryIndex"]]);
            $manager->persist($show);
            $shows[] = $show;
        }

        $showVideosData = [
            // Films
            ["showIndex" => 0, "description" => "Bande-annonce officielle de Dune: Deuxième Partie", "image" => "dune-deuxieme-partie-h.webp", "url" => "https://www.youtube.com/watch?v=oGimpDBwkFc", "videoQuality" => "4K HDR", "duration" => "00:02:51"],
            ["showIndex" => 1, "description" => "Bande-annonce officielle d'Oppenheimer", "image" => "oppenheimer-h.webp", "url" => "https://www.youtube.com/watch?v=CoXtvSRpHgM", "videoQuality" => "Full HD", "duration" => "00:03:08"],
            ["showIndex" => 2, "description" => "Bande-annonce officielle d'Interstellar", "image" => "interstellar-h.webp", "url" => "https://www.youtube.com/watch?v=VaOijhK3CRU", "videoQuality" => "4K HDR", "duration" => "00:02:20"],
            ["showIndex" => 3, "description" => "Bande-annonce officielle d'Inception", "image" => "inception-h.webp", "url" => "https://www.youtube.com/watch?v=CPTIgILtna8", "videoQuality" => "Full HD", "duration" => "00:02:12"],
            ["showIndex" => 4, "description" => "Bande-annonce officielle de Don't Worry Darling", "image" => "dont-worry-darling-h.webp", "url" => "https://www.youtube.com/watch?v=ekDr_wHbMaM", "videoQuality" => "4K HDR", "duration" => "00:02:37"],
            ["showIndex" => 5, "description" => "Bande-annonce officielle de Mad Max: Fury Road", "image" => "mad-max-h.webp", "url" => "https://www.youtube.com/watch?v=mtolAJbj44s", "videoQuality" => "4K HDR", "duration" => "00:02:30"],
            ["showIndex" => 6, "description" => "Bande-annonce officielle d'Indiana Jones et le Cadran", "image" => "indiana-jones-et-le-cadran-h.webp", "url" => "https://www.youtube.com/watch?v=4tvtYAMPsxI", "videoQuality" => "4K HDR", "duration" => "00:02:17"],
            ["showIndex" => 7, "description" => "Bande-annonce officielle de Conjuring", "image" => "conjuring-h.webp", "url" => "https://www.youtube.com/watch?v=McOmzgX09wo", "videoQuality" => "Full HD", "duration" => "00:02:23"],
            ["showIndex" => 8, "description" => "Bande-annonce officielle d'Anatomie d'une chute", "image" => "anatomie-d-une-chute-h.webp", "url" => "https://www.youtube.com/watch?v=p8jiyTRfTFM", "videoQuality" => "4K HDR", "duration" => "00:01:22"],
            ["showIndex" => 9, "description" => "Bande-annonce officielle de John Wick", "image" => "john-wick-h.webp", "url" => "https://www.youtube.com/watch?v=pWK5crMuhHY", "videoQuality" => "4K HDR", "duration" => "00:02:28"],

            // Séries
            ["showIndex" => 10, "description" => "Bande-annonce officielle de The Last of Us - Saison 1", "image" => "the-last-of-us-h.webp", "url" => "https://www.youtube.com/watch?v=uLtkt8BonwM", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:02:12"],
            ["showIndex" => 10, "description" => "Bande-annonce officielle de The Last of Us - Saison 2", "image" => "the-last-of-us-h.webp", "url" => "https://www.youtube.com/watch?v=hU5dNOMUzkc", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:01:58"],

            ["showIndex" => 11, "description" => "Bande-annonce officielle de Squid Game - Saison 1", "image" => "squid-game-h.webp", "url" => "https://www.youtube.com/watch?v=GYoD8oOH31M", "saisonNumber" => 1, "videoQuality" => "Full HD", "duration" => "00:02:19"],
            ["showIndex" => 11, "description" => "Bande-annonce officielle de Squid Game - Saison 2", "image" => "squid-game-h.webp", "url" => "https://www.youtube.com/watch?v=0bzcYhRiR4k", "saisonNumber" => 2, "videoQuality" => "Full HD", "duration" => "00:01:48"],
            ["showIndex" => 11, "description" => "Bande-annonce officielle de Squid Game - Saison 3", "image" => "squid-game-h.webp", "url" => "https://www.youtube.com/watch?v=aQAbx8XZBII", "saisonNumber" => 3, "videoQuality" => "Full HD", "duration" => "00:02:00"],

            ["showIndex" => 12, "description" => "Bande-annonce officielle de Stranger Things - Saison 1", "image" => "stranger-things-h.webp", "url" => "https://www.youtube.com/watch?v=l7nzodXfVsg", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:02:25"],
            ["showIndex" => 12, "description" => "Bande-annonce officielle de Stranger Things - Saison 2", "image" => "stranger-things-h.webp", "url" => "https://www.youtube.com/watch?v=qDG8eGaikSU", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:03:13"],
            ["showIndex" => 12, "description" => "Bande-annonce officielle de Stranger Things - Saison 3", "image" => "stranger-things-h.webp", "url" => "https://www.youtube.com/watch?v=RCOSpMygVjI", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:03:17"],
            ["showIndex" => 12, "description" => "Bande-annonce officielle de Stranger Things - Saison 4", "image" => "stranger-things-h.webp", "url" => "https://www.youtube.com/watch?v=sBEvEcpnG7k", "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:02:05"],
            ["showIndex" => 12, "description" => "Bande-annonce officielle de Stranger Things - Saison 5", "image" => "stranger-things-h.webp", "url" => "https://www.youtube.com/watch?v=Ruxm-kwgOdk", "saisonNumber" => 5, "videoQuality" => "4K HDR", "duration" => "00:02:54"],

            ["showIndex" => 13, "description" => "Bande-annonce officielle de La Casa de Papel - Saison 1", "image" => "la-casa-de-papel-h.webp", "url" => "https://www.youtube.com/watch?v=_yJxbWKN3zE", "saisonNumber" => 1, "videoQuality" => "Full HD", "duration" => "00:02:12"],
            ["showIndex" => 13, "description" => "Bande-annonce officielle de La Casa de Papel - Saison 2", "image" => "la-casa-de-papel-h.webp", "url" => "https://www.youtube.com/watch?v=GySGCL0zLC0", "saisonNumber" => 2, "videoQuality" => "Full HD", "duration" => "00:02:01"],
            ["showIndex" => 13, "description" => "Bande-annonce officielle de La Casa de Papel - Saison 3", "image" => "la-casa-de-papel-h.webp", "url" => "https://www.youtube.com/watch?v=7xZ_mpLLTEM", "saisonNumber" => 3, "videoQuality" => "Full HD", "duration" => "00:02:05"],
            ["showIndex" => 13, "description" => "Bande-annonce officielle de La Casa de Papel - Saison 4", "image" => "la-casa-de-papel-h.webp", "url" => "https://www.youtube.com/watch?v=iXxah21K7YE", "saisonNumber" => 4, "videoQuality" => "Full HD", "duration" => "00:02:08"],
            ["showIndex" => 13, "description" => "Bande-annonce officielle de La Casa de Papel - Saison 5", "image" => "la-casa-de-papel-h.webp", "url" => "https://www.youtube.com/watch?v=oGPtJ7Lpvv4", "saisonNumber" => 5, "videoQuality" => "Full HD", "duration" => "00:00:44"],

            ["showIndex" => 14, "description" => "Bande-annonce officielle de Lupin - Saison 1", "image" => "lupin-h.webp", "url" => "https://www.youtube.com/watch?v=gCmuYqeeNpc", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:02:34"],
            ["showIndex" => 14, "description" => "Bande-annonce officielle de Lupin - Saison 2", "image" => "lupin-h.webp", "url" => "https://www.youtube.com/watch?v=P5RCDq9XYjA", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:02:27"],
            ["showIndex" => 14, "description" => "Bande-annonce officielle de Lupin - Saison 3", "image" => "lupin-h.webp", "url" => "https://www.youtube.com/watch?v=njRsmGOIJVg", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:02:05"],
            ["showIndex" => 14, "description" => "Bande-annonce officielle de Lupin - Saison 4", "image" => "lupin-h.webp", "url" => "https://www.youtube.com/watch?v=NTkfVFmIH2c", "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:02:29"],

            ["showIndex" => 15, "description" => "Bande-annonce officielle de Dark - Saison 1", "image" => "dark-h.webp", "url" => "https://www.youtube.com/watch?v=vx9HQwjTcXI", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:02:33"],
            ["showIndex" => 15, "description" => "Bande-annonce officielle de Dark - Saison 2", "image" => "dark-h.webp", "url" => "https://www.youtube.com/watch?v=S65L28FqiaM", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:01:33"],
            ["showIndex" => 15, "description" => "Bande-annonce officielle de Dark - Saison 3", "image" => "dark-h.webp", "url" => "https://www.youtube.com/watch?v=H-3pa7P3wVw", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:02:29"],

            ["showIndex" => 16, "description" => "Bande-annonce officielle de The Umbrella Academy - Saison 1", "image" => "the-umbrella-academy-h.webp", "url" => "https://www.youtube.com/watch?v=m72aT-pvdiI", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:01:59"],
            ["showIndex" => 16, "description" => "Bande-annonce officielle de The Umbrella Academy - Saison 2", "image" => "the-umbrella-academy-h.webp", "url" => "https://www.youtube.com/watch?v=DpMjj60oxFk", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:02:45"],
            ["showIndex" => 16, "description" => "Bande-annonce officielle de The Umbrella Academy - Saison 3", "image" => "the-umbrella-academy-h.webp", "url" => "https://www.youtube.com/watch?v=qYMc-f6oHn4", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:02:23"],
            ["showIndex" => 16, "description" => "Bande-annonce officielle de The Umbrella Academy - Saison 4", "image" => "the-umbrella-academy-h.webp", "url" => "https://www.youtube.com/watch?v=p5NIjTLtduc", "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:02:09"],

            ["showIndex" => 17, "description" => "Bande-annonce officielle de The Witcher - Saison 1", "image" => "the-witcher-h.webp", "url" => "https://www.youtube.com/watch?v=bGFpSNKtLlc", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:01:36"],
            ["showIndex" => 17, "description" => "Bande-annonce officielle de The Witcher - Saison 2", "image" => "the-witcher-h.webp", "url" => "https://www.youtube.com/watch?v=1V0VY5lBXPI", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:03:07"],
            ["showIndex" => 17, "description" => "Bande-annonce officielle de The Witcher - Saison 3", "image" => "the-witcher-h.webp", "url" => "https://www.youtube.com/watch?v=aWVOt_X0ls0", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:02:43"],
            ["showIndex" => 17, "description" => "Bande-annonce officielle de The Witcher - Saison 4", "image" => "the-witcher-h.webp", "url" => "https://www.youtube.com/watch?v=7W2V3HKUo98", "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:02:29"],

            ["showIndex" => 18, "description" => "Bande-annonce officielle de House of the Dragon - Saison 1", "image" => "house-of-the-dragon-h.webp", "url" => "https://www.youtube.com/watch?v=a2zgNEUfGyA", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:02:26"],
            ["showIndex" => 18, "description" => "Bande-annonce officielle de House of the Dragon - Saison 2", "image" => "house-of-the-dragon-h.webp", "url" => "https://www.youtube.com/watch?v=Z56QCuYEvPo", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:02:21"],
            ["showIndex" => 18, "description" => "Bande-annonce officielle de House of the Dragon - Saison 3", "image" => "house-of-the-dragon-h.webp", "url" => "https://www.youtube.com/watch?v=FijHivfF3DY", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:02:20"],

            ["showIndex" => 19, "description" => "Bande-annonce officielle de Peaky Blinders - Saison 1", "image" => "peaky-blinders-h.webp", "url" => "https://www.youtube.com/watch?v=F16x9poSXrc", "saisonNumber" => 1, "videoQuality" => "Full HD", "duration" => "00:00:30"],
            ["showIndex" => 19, "description" => "Bande-annonce officielle de Peaky Blinders - Saison 2", "image" => "peaky-blinders-h.webp", "url" => "https://www.youtube.com/watch?v=uIJ07Wg5i0k", "saisonNumber" => 2, "videoQuality" => "Full HD", "duration" => "00:01:37"],
            ["showIndex" => 19, "description" => "Bande-annonce officielle de Peaky Blinders - Saison 3", "image" => "peaky-blinders-h.webp", "url" => "https://www.youtube.com/watch?v=t5D4-nTAWLY", "saisonNumber" => 3, "videoQuality" => "Full HD", "duration" => "00:01:50"],
            ["showIndex" => 19, "description" => "Bande-annonce officielle de Peaky Blinders - Saison 4", "image" => "peaky-blinders-h.webp", "url" => "https://www.youtube.com/watch?v=whgdkjDJAjg", "saisonNumber" => 4, "videoQuality" => "Full HD", "duration" => "00:01:00"],
            ["showIndex" => 19, "description" => "Bande-annonce officielle de Peaky Blinders - Saison 5", "image" => "peaky-blinders-h.webp", "url" => "https://www.youtube.com/watch?v=OU1iZoOrkVo", "saisonNumber" => 5, "videoQuality" => "Full HD", "duration" => "00:01:50"],
            ["showIndex" => 19, "description" => "Bande-annonce officielle de Peaky Blinders - Saison 6", "image" => "peaky-blinders-h.webp", "url" => "https://www.youtube.com/watch?v=QlU-5RsnYTk", "saisonNumber" => 6, "videoQuality" => "Full HD", "duration" => "00:01:44"],

            // Dessins animés
            ["showIndex" => 20, "description" => "Bande-annonce officielle du Garçon et le Héron", "image" => "le-garcon-et-le-heron-h.webp", "url" => "https://www.youtube.com/watch?v=Q2aTi0BQXek", "videoQuality" => "Full HD", "duration" => "00:01:28"],
            ["showIndex" => 21, "description" => "Bande-annonce officielle de Vaïana 2", "image" => "vaiana-2-h.webp", "url" => "https://www.youtube.com/watch?v=Se8ZXbLJUPI", "videoQuality" => "4K HDR", "duration" => "00:02:22"],

            ["showIndex" => 22, "description" => "Bande-annonce officielle d'Arcane - Saison 1", "image" => "arcane-h.webp", "url" => "https://www.youtube.com/watch?v=OweSahDkNtI", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:02:45"],
            ["showIndex" => 22, "description" => "Bande-annonce officielle d'Arcane - Saison 2", "image" => "arcane-h.webp", "url" => "https://www.youtube.com/watch?v=eev9CY3SWQE", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:02:20"],

            ["showIndex" => 23, "description" => "Bande-annonce officielle du Voyage de Chihiro", "image" => "le-voyage-de-chihiro-h.webp", "url" => "https://www.youtube.com/watch?v=ByXuk9QqQkk", "videoQuality" => "Full HD", "duration" => "00:02:26"],
            ["showIndex" => 24, "description" => "Bande-annonce officielle de Princesse Mononoké", "image" => "princesse-mononoke-h.webp", "url" => "https://www.youtube.com/watch?v=NWV5ijop5PY", "videoQuality" => "Full HD", "duration" => "00:01:28"],
            ["showIndex" => 25, "description" => "Bande-annonce officielle de Mon Voisin Totoro", "image" => "mon-voisin-totoro-h.webp", "url" => "https://www.youtube.com/watch?v=jD-6_0h4KwM", "videoQuality" => "Full HD", "duration" => "00:01:30"],

            ["showIndex" => 26, "description" => "Bande-annonce officielle de Demon Slayer - Saison 1", "image" => "demon-slayer-h.webp", "url" => "https://www.youtube.com/watch?v=ph5ra_LwmEs", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:01:41"],
            ["showIndex" => 26, "description" => "Bande-annonce officielle de Demon Slayer - Saison 2 (Le Quartier des Plaisirs)", "image" => "demon-slayer-h.webp", "url" => "https://www.youtube.com/watch?v=InLnfJmCcIQ", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:01:35"],
            ["showIndex" => 26, "description" => "Bande-annonce officielle de Demon Slayer - Saison 3 (Le Village des Forgerons)", "image" => "demon-slayer-h.webp", "url" => "https://www.youtube.com/watch?v=muoKw0luYco", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:00:59"],
            ["showIndex" => 26, "description" => "Bande-annonce officielle de Demon Slayer - Saison 4 (Entraînement des Piliers)", "image" => "demon-slayer-h.webp", "url" => "https://www.youtube.com/watch?v=iOBaZ__GRCc", "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:01:38"],

            ["showIndex" => 27, "description" => "Bande-annonce officielle de L'Attaque des Titans - Saison 1", "image" => "l-attaque-des-titans-h.webp", "url" => "https://www.youtube.com/watch?v=lu0IASPFf3k", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:02:01"],
            ["showIndex" => 27, "description" => "Bande-annonce officielle de L'Attaque des Titans - Saison 2", "image" => "l-attaque-des-titans-h.webp", "url" => "https://www.youtube.com/watch?v=nxBFhCt9pPQ", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:01:37"],
            ["showIndex" => 27, "description" => "Bande-annonce officielle de L'Attaque des Titans - Saison 3", "image" => "l-attaque-des-titans-h.webp", "url" => "https://www.youtube.com/watch?v=ou4zFtWBjAg", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:01:23"],
            ["showIndex" => 27, "description" => "Bande-annonce officielle de L'Attaque des Titans - Saison 4", "image" => "l-attaque-des-titans-h.webp", "url" => "https://www.youtube.com/watch?v=KnpVhlDoogM", "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:02:34"],

            ["showIndex" => 28, "description" => "Bande-annonce officielle de Jujutsu Kaisen - Saison 1", "image" => "jujutsu-kaisen-h.webp", "url" => "https://www.youtube.com/watch?v=hkir9oZs0M0", "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "00:01:12"],
            ["showIndex" => 28, "description" => "Bande-annonce officielle de Jujutsu Kaisen - Saison 2", "image" => "jujutsu-kaisen-h.webp", "url" => "https://www.youtube.com/watch?v=tyHJnam1XrA", "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:01:25"],
            ["showIndex" => 28, "description" => "Bande-annonce officielle de Jujutsu Kaisen - Saison 3", "image" => "jujutsu-kaisen-h.webp", "url" => "https://www.youtube.com/watch?v=yWFzzOVnd7I", "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:01:45"],

            ["showIndex" => 29, "description" => "Bande-annonce officielle de Spider-Man: New Generation", "image" => "spider-man-new-generation-h.webp", "url" => "https://www.youtube.com/watch?v=-AnN_Xg2Nps", "videoQuality" => "4K HDR", "duration" => "00:02:25"],
        ];

        $defaultEpisodeCount = 10;
        foreach ($showVideosData as $showVideoData) {
            $duration = $this->toSeconds($showVideoData["duration"]);
            $showVideo = new ShowVideo();
            $showVideo->setDescriptionVideo($showVideoData["description"]);
            $showVideo->setImageVideo($showVideoData["image"]);
            $showVideo->setUrlVideo($showVideoData["url"]);
            $showVideo->setEpisodeNumber($showVideoData["episodeNumber"] ?? null);
            $showVideo->setSaisonNumber($showVideoData["saisonNumber"] ?? null);
            $showVideo->setVideoQuality($showVideoData["videoQuality"]);
            $showVideo->setDuration($duration);
            $showVideo->setShow($shows[$showVideoData["showIndex"]]);
            $manager->persist($showVideo);
            $saison = $showVideoData["saisonNumber"] ?? null;
            if ($saison === null) {
                continue;
            }

            $episodeCount = $showVideoData["episodeCount"]
                ?? ($saison <= 2 ? $defaultEpisodeCount : 0);


            $show = $shows[$showVideoData["showIndex"]];

            for ($episode = 1; $episode <= $episodeCount; $episode++) {
                $video = new ShowVideo();
                $video->setDescriptionVideo($show->getTitle() . " - Saison $saison, Épisode $episode");
                $video->setImageVideo($showVideoData["image"]);
                $video->setUrlVideo($showVideoData["url"]);
                $video->setSaisonNumber($saison);
                $video->setEpisodeNumber($episode);
                $video->setVideoQuality($showVideoData["videoQuality"]);
                $video->setDuration($duration);
                $video->setShow($show);
                $manager->persist($video);
            }
        }

        $manager->flush();
    }

    private function toSeconds(string $time): int
    {
        [$hours, $minutes, $seconds] = explode(':', $time);

        return (int) $hours * 3600 + (int) $minutes * 60 + (int) $seconds;
    }
}
