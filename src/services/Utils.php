<?php

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('home'); 
 */
class Utils {
    /**
     * Convertit une date vers le format de type "30.03 12:46" en francais.
     * @param DateTime $date : la date à convertir.
     * @return string : la date convertie.
     */
    public static function convertDateFormatLong(DateTime $date) : string
    {
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('dd.MM H:mm');

        return $dateFormatter->format($date);
    }

    /**
     * Convertit une date vers le format de type heure.
     * @param DateTime $date : la date à convertir.
     * @return string : la date convertie.
     */
    public static function convertDateFormatShort(DateTime $date) : string
    {
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('H:mm');

        return $dateFormatter->format($date);
    }

    /**
     * Redirige vers une URL.
     * @param string $action : l'action que l'on veut faire (correspond aux actions dans le routeur).
     * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
     * @return void
     */
    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    /**
     * Cette méthode retourne le code js a insérer en attribut d'un bouton.
     * pour ouvrir une popup "confirm", et n'effectuer l'action que si l'utilisateur
     * a bien cliqué sur "ok".
     * @param string $message : le message à afficher dans la popup.
     * @return string : le code js à insérer dans le bouton.
     */
    public static function askConfirmation(string $message) : string
    {
        return "onclick=\"return confirm('$message');\"";
    }

    /**
     * Cette méthode protège une chaine de caractères contre les attaques XSS.
     * De plus, elle transforme les retours à la ligne en balises <p> pour un affichage plus agréable. 
     * @param string $string : la chaine à protéger.
     * @return string : la chaine protégée.
     */
    public static function format(string $string) : string
    {
        // Etape 1, on protège le texte avec htmlspecialchars.
        $finalString = htmlspecialchars($string, ENT_QUOTES);

        // Etape 2, le texte va être découpé par rapport aux retours à la ligne, 
        $lines = explode("\n", $finalString);

        // On reconstruit en mettant chaque ligne dans un paragraphe (et en sautant les lignes vides).
        $finalString = "";
        foreach ($lines as $line) {
            if (trim($line) != "") {
                $finalString .= "<p>$line</p>";
            }
        }
        
        return $finalString;
    }

    /**
     * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
     * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
     * ou celle qui est passée en paramètre si elle existe.
     * @param string $variableName : le nom de la variable à récupérer.
     * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
     * @return mixed : la valeur de la variable ou la valeur par défaut.
     */
    public static function request(string $variableName, mixed $defaultValue = null) : mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

    /**
    * Méthode pour valider une image
    * @param array $file Le fichier à valider
    * @param int $maxSize La taille maximale du fichier
    * @param array $validExtensions Les extensions valides pour le fichier
    * @return array Un tableau contenant les erreurs
    */
    private static function imageValidate($file, $maxSize = 1500000, $validExtensions = ['jpg', 'jpeg', 'png', 'webp']) : array
    {
        $errors = [];
        $fileSize = $file['size'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if ($fileSize > $maxSize) {
            $errors[] = "Le fichier est trop grand.";
        }

        if (!in_array($fileExtension, $validExtensions)) {
            $errors[] = "Seuls les formats jpg, jpeg, png et webp sont autorisés.";
        }

        return $errors;
    }

    /**
    * Méthode pour télécharger une image
    * @param string $fileName Le nom du fichier à télécharger
    * @param string $targetDir Le répertoire dans lequel télécharger le fichier
    * @return array Un tableau contenant les erreurs et le chemin du fichier téléchargé 
    */
    public static function uploadImage($fileName, $targetDir): array
    {
        $targetFile = $targetDir . basename($_FILES[$fileName]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        // valider l'image
        $picErrors = self::imageValidate($_FILES[$fileName]);

        if (!empty ($picErrors)) {
        return [$picErrors, null];
        }

        if (!move_uploaded_file($_FILES[$fileName]["tmp_name"], $targetFile)) {
        $picErrors[] = "Votre fichier n'a pas pu être téléchargé.";

        return [$picErrors, null];
        }

        return [$picErrors, $targetFile];
    }
}
