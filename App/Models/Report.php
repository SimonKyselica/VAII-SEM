<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * Class Report
 * A bug report or feedback from a tester, stored in the `reports` table.
 *
 * Columns type, severity and status store short codes; the labels shown in the UI are in the constants below, so the
 * form, the list and the validation in the controller all use the same values.
 *
 * @package App\Models
 */
class Report extends Model
{
    /** Report types: code in DB => label in UI */
    public const TYPES = [
        'bug' => 'Bug',
        'crash' => 'Crash',
        'suggestion' => 'Suggestion',
        'other' => 'Other',
    ];

    /** Severities: code in DB => label in UI (codes match the .severity--* classes in hlasenia.css) */
    public const SEVERITIES = [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
        'critical' => 'Critical',
    ];

    /** Statuses: code in DB => label in UI */
    public const STATUSES = [
        'new' => 'New',
        'confirmed' => 'Confirmed',
        'in_progress' => 'In progress',
        'fixed' => 'Fixed',
        'rejected' => 'Rejected',
    ];

    /**
     * Properties that setFromRequest() may set from a form. id and createdAt are left out on purpose: the primary key
     * comes from the database and the creation date is set by the controller, never by the user.
     */
    protected static ?array $fillable = ['title', 'type', 'severity', 'status', 'description', 'buildId'];

    protected ?int $id = null;
    protected ?int $buildId = null;
    protected ?string $title = null;
    protected ?string $type = null;
    protected ?string $severity = null;
    // The ORM inserts every column, so a DEFAULT in the database would never be used; the default lives here instead.
    protected ?string $status = 'new';
    protected ?string $description = null;
    protected ?string $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuildId(): ?int
    {
        return $this->buildId;
    }

    public function setBuildId(int $buildId): void
    {
        $this->buildId = $buildId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getSeverity(): ?string
    {
        return $this->severity;
    }

    public function setSeverity(string $severity): void
    {
        $this->severity = $severity;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getBuild(): ?Build {
        return $this->getOneRelated(Build::class);
    }

    /**
     * @return string|null Date and time in the database format, e.g. "2026-11-07 13:15:45".
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt Date and time in the database format, e.g. date('Y-m-d H:i:s').
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Label of the type for the UI, e.g. "Crash" for "crash". Unknown codes are returned unchanged.
     */
    public function getTypeLabel(): string
    {
        return self::TYPES[$this->type] ?? (string)$this->type;
    }

    /**
     * Label of the severity for the UI, e.g. "Critical" for "critical".
     */
    public function getSeverityLabel(): string
    {
        return self::SEVERITIES[$this->severity] ?? (string)$this->severity;
    }

    /**
     * Label of the status for the UI, e.g. "In progress" for "in_progress".
     */
    public function getStatusLabel(): string
    {
        return self::STATUSES[$this->status] ?? (string)$this->status;
    }
}
