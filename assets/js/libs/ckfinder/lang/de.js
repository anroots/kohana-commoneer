﻿/*
 * CKFinder
 * ========
 * http://ckfinder.com
 * Copyright (C) 2007-2011, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file, and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying, or distributing this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object for the German
 *		language.
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['de'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nicht verfügbar</span>',
		confirmCancel	: 'Einige Optionen wurden geändert. Wollen Sie den Dialog dennoch schließen?',
		ok				: 'OK',
		cancel			: 'Abbrechen',
		confirmationTitle	: 'Confirmation', // MISSING
		messageTitle	: 'Information', // MISSING
		inputTitle		: 'Frage',
		undo			: 'Rückgängig',
		redo			: 'Wiederherstellen',
		skip			: 'Skip', // MISSING
		skipAll			: 'Skip all', // MISSING
		makeDecision	: 'What action should be taken?', // MISSING
		rememberDecision: 'Remember my decision' // MISSING
	},


	dir : 'ltr',
	HelpLang : 'en',
	LangCode : 'de',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'd.m.yyyy H:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Verzeichnisse',
	FolderLoading	: 'Laden...',
	FolderNew		: 'Bitte geben Sie den neuen Verzeichnisnamen an: ',
	FolderRename	: 'Bitte geben Sie den neuen Verzeichnisnamen an: ',
	FolderDelete	: 'Wollen Sie wirklich den Ordner "%1" löschen?',
	FolderRenaming	: ' (Umbenennen...)',
	FolderDeleting	: ' (Löschen...)',

	// Files
	FileRename		: 'Bitte geben Sie den neuen Dateinamen an: ',
	FileRenameExt	: 'Wollen Sie wirklich die Dateierweiterung ändern? Die Datei könnte unbrauchbar werden!',
	FileRenaming	: 'Umbennenen...',
	FileDelete		: 'Wollen Sie wirklich die Datei "%1" löschen?',
	FilesLoading	: 'Laden...',
	FilesEmpty		: 'The folder is empty.', // MISSING
	FilesMoved		: 'File %1 moved to %2:%3.', // MISSING
	FilesCopied		: 'File %1 copied to %2:%3.', // MISSING

	// Basket
	BasketFolder		: 'Basket', // MISSING
	BasketClear			: 'Clear Basket', // MISSING
	BasketRemove		: 'Remove from Basket', // MISSING
	BasketOpenFolder	: 'Open Parent Folder', // MISSING
	BasketTruncateConfirm : 'Do you really want to remove all files from the basket?', // MISSING
	BasketRemoveConfirm	: 'Do you really want to remove the file "%1" from the basket?', // MISSING
	BasketEmpty			: 'No files in the basket, drag and drop some.', // MISSING
	BasketCopyFilesHere	: 'Copy Files from Basket', // MISSING
	BasketMoveFilesHere	: 'Move Files from Basket', // MISSING

	BasketPasteErrorOther	: 'File %s error: %e', // MISSING
	BasketPasteMoveSuccess	: 'The following files were moved: %s', // MISSING
	BasketPasteCopySuccess	: 'The following files were copied: %s', // MISSING

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Hochladen',
	UploadTip	: 'Neue Datei hochladen',
	Refresh		: 'Aktualisieren',
	Settings	: 'Einstellungen',
	Help		: 'Hilfe',
	HelpTip		: 'Hilfe',

	// Context Menus
	Select			: 'Auswählen',
	SelectThumbnail : 'Miniatur auswählen',
	View			: 'Ansehen',
	Download		: 'Herunterladen',

	NewSubFolder	: 'Neues Unterverzeichnis',
	Rename			: 'Umbenennen',
	Delete			: 'Löschen',

	CopyDragDrop	: 'Copy File Here', // MISSING
	MoveDragDrop	: 'Move File Here', // MISSING

	// Dialogs
	RenameDlgTitle		: 'Rename', // MISSING
	NewNameDlgTitle		: 'New Name', // MISSING
	FileExistsDlgTitle	: 'File Already Exists', // MISSING
	SysErrorDlgTitle : 'Systemfehler',

	FileOverwrite	: 'Overwrite', // MISSING
	FileAutorename	: 'Auto-rename', // MISSING

	// Generic
	OkBtn		: 'OK',
	CancelBtn	: 'Abbrechen',
	CloseBtn	: 'Schließen',

	// Upload Panel
	UploadTitle			: 'Neue Datei hochladen',
	UploadSelectLbl		: 'Bitte wählen Sie die Datei aus',
	UploadProgressLbl	: '(Die Daten werden übertragen, bitte warten...)',
	UploadBtn			: 'Ausgewählte Datei hochladen',
	UploadBtnCancel		: 'Abbrechen',

	UploadNoFileMsg		: 'Bitte wählen Sie eine Datei auf Ihrem Computer aus.',
	UploadNoFolder		: 'Please select a folder before uploading.', // MISSING
	UploadNoPerms		: 'File upload not allowed.', // MISSING
	UploadUnknError		: 'Error sending the file.', // MISSING
	UploadExtIncorrect	: 'File extension not allowed in this folder.', // MISSING

	// Flash Uploads
	UploadLabel			: 'Files to Upload', // MISSING
	UploadTotalFiles	: 'Total Files:', // MISSING
	UploadTotalSize		: 'Total Size:', // MISSING
	UploadAddFiles		: 'Add Files', // MISSING
	UploadClearFiles	: 'Clear Files', // MISSING
	UploadCancel		: 'Cancel Upload', // MISSING
	UploadRemove		: 'Entfernen',
	UploadRemoveTip		: 'Remove !f', // MISSING
	UploadUploaded		: 'Uploaded !n%', // MISSING
	UploadProcessing	: 'Processing...', // MISSING

	// Settings Panel
	SetTitle		: 'Einstellungen',
	SetView			: 'Ansicht:',
	SetViewThumb	: 'Miniaturansicht',
	SetViewList		: 'Liste',
	SetDisplay		: 'Anzeige:',
	SetDisplayName	: 'Dateiname',
	SetDisplayDate	: 'Datum',
	SetDisplaySize	: 'Dateigröße',
	SetSort			: 'Sortierung:',
	SetSortName		: 'nach Dateinamen',
	SetSortDate		: 'nach Datum',
	SetSortSize		: 'nach Größe',

	// Status Bar
	FilesCountEmpty : '<Leeres Verzeichnis>',
	FilesCountOne	: '1 Datei',
	FilesCountMany	: '%1 Datei',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/s',

	// Connector Error Messages.
	ErrorUnknown	: 'Ihre Anfrage konnte nicht bearbeitet werden. (Fehler %1)',
	Errors :
	{
	 10 : 'Unbekannter Befehl.',
	 11 : 'Der Ressourcentyp wurde nicht spezifiziert.',
	 12 : 'Der Ressourcentyp ist nicht gültig.',
	102 : 'Ungültiger Datei oder Verzeichnisname.',
	103 : 'Ihre Anfrage konnte wegen Authorisierungseinschränkungen nicht durchgeführt werden.',
	104 : 'Ihre Anfrage konnte wegen Dateisystemeinschränkungen nicht durchgeführt werden.',
	105 : 'Invalid file extension.',
	109 : 'Unbekannte Anfrage.',
	110 : 'Unbekannter Fehler.',
	115 : 'Es existiert bereits eine Datei oder ein Ordner mit dem gleichen Namen.',
	116 : 'Verzeichnis nicht gefunden. Bitte aktualisieren Sie die Anzeige und versuchen es noch einmal.',
	117 : 'Datei nicht gefunden. Bitte aktualisieren Sie die Dateiliste und versuchen es noch einmal.',
	118 : 'Source and target paths are equal.', // MISSING
	201 : 'Es existiert bereits eine Datei unter gleichem Namen. Die hochgeladene Datei wurde unter "%1" gespeichert.',
	202 : 'Ungültige Datei.',
	203 : 'ungültige Datei. Die Dateigröße ist zu groß.',
	204 : 'Die hochgeladene Datei ist korrupt.',
	205 : 'Es existiert kein temp. Ordner für das Hochladen auf den Server.',
	206 : 'Das Hochladen wurde aus Sicherheitsgründen abgebrochen. Die Datei enthält HTML-Daten.',
	207 : 'Die hochgeladene Datei wurde unter "%1" gespeichert.',
	300 : 'Moving file(s) failed.', // MISSING
	301 : 'Copying file(s) failed.', // MISSING
	500 : 'Der Dateibrowser wurde aus Sicherheitsgründen deaktiviert. Bitte benachrichtigen Sie Ihren Systemadministrator und prüfen Sie die Konfigurationsdatei.',
	501 : 'Die Miniaturansicht wurde deaktivert.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'Der Dateinamen darf nicht leer sein.',
		FileExists		: 'File %s already exists.', // MISSING
		FolderEmpty		: 'Der Verzeichnisname darf nicht leer sein.',

		FileInvChar		: 'Der Dateinamen darf nicht eines der folgenden Zeichen enthalten: \n\\ / : * ? " < > |',
		FolderInvChar	: 'Der Verzeichnisname darf nicht eines der folgenden Zeichen enthalten: \n\\ / : * ? " < > |',

		PopupBlockView	: 'Die Datei konnte nicht in einem neuen Fenster geöffnet werden. Bitte deaktivieren Sie in Ihrem Browser alle Popup-Blocker für diese Seite.',
		XmlError		: 'It was not possible to properly load the XML response from the web server.', // MISSING
		XmlEmpty		: 'It was not possible to load the XML response from the web server. The server returned an empty response.', // MISSING
		XmlRawResponse	: 'Raw response from the server: %s' // MISSING
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Resize %s', // MISSING
		sizeTooBig		: 'Cannot set image height or width to a value bigger than the original size (%size).', // MISSING
		resizeSuccess	: 'Image resized successfully.', // MISSING
		thumbnailNew	: 'Create a new thumbnail', // MISSING
		thumbnailSmall	: 'Klein (%s)',
		thumbnailMedium	: 'Mittel (%s)',
		thumbnailLarge	: 'Groß (%s)',
		newSize			: 'Set a new size', // MISSING
		width			: 'Breite',
		height			: 'Höhe',
		invalidHeight	: 'Invalid height.', // MISSING
		invalidWidth	: 'Invalid width.', // MISSING
		invalidName		: 'Invalid file name.', // MISSING
		newImage		: 'Create a new image', // MISSING
		noExtensionChange : 'File extension cannot be changed.', // MISSING
		imageSmall		: 'Source image is too small.', // MISSING
		contextMenuName	: 'Resize', // MISSING
		lockRatio		: 'Größenverhältnis beibehalten',
		resetSize		: 'Größe zurücksetzen'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Speichern',
		fileOpenError	: 'Unable to open file.', // MISSING
		fileSaveSuccess	: 'File saved successfully.', // MISSING
		contextMenuName	: 'Edit', // MISSING
		loadingFile		: 'Loading file, please wait...' // MISSING
	},

	Maximize :
	{
		maximize : 'Maximieren',
		minimize : 'Minimieren'
	}
};
