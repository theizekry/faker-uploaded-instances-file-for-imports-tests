<?php

namespace App\FakerUploadedInstanceGenerator\Traits;

use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

trait CreateFakeUploadedFileObjectWithContent
{
    /**
     * The disk name that used to create a fake storage disk.
     *
     * @var string $fakeDiskName
     */
    private string $fakeDiskName = 'fake-disk';

    /**
     * Generate and create a fake CSV uploaded file instance by the given content.
     *
     * @param $headingRow
     * @param $data
     *
     * @return bool|UploadedFile
     */
    public function createFakeCsvUploadedFileWithContent($headingRow, $data)
    {
        // Create a Fake Storage Disk.
        Storage::fake($this->fakeDiskName);

        // Get a Fake Exportable Class.
        $fakeExportableClass = $this->getFakeAnonymousExportableClass($headingRow, $data);

        $file_name = 'fake-file.csv';

        // Store the Content by the Exportable Class to recently created Fake Disk.
        if (! Excel::store($fakeExportableClass, $file_name, $this->fakeDiskName, \Maatwebsite\Excel\Excel::CSV)) {
            return false;
        }

        // Create and return a Test Uploaded Instance by the recently stored file.
        return $this->createUploadedFileInstance($file_name);
    }

    /**
     * Generate and create a fake XLS uploaded file instance by the given content.
     *
     * @param array $headingRow
     * @param array $data
     *
     * @return bool|UploadedFile
     */
    public function createFakeXlsUploadedFileWithContent(array $headingRow, array $data)
    {
        // Create a Fake Storage Disk.
        Storage::fake($this->fakeDiskName);

        // Get a Fake Exportable Class.
        $fakeExportableClass = $this->getFakeAnonymousExportableClass($headingRow, $data);

        $file_name = 'fake-file.xls';

        // Store the Content by the Exportable Class to recently created Fake Disk.
        if (! Excel::store($fakeExportableClass, $file_name, $this->fakeDiskName, \Maatwebsite\Excel\Excel::XLS)) {
            return false;
        }

        // Create and return a Test Uploaded Instance by the recently stored file.
        return $this->createUploadedFileInstance($file_name);
    }

    /**
     * Generate and create a fake XLSX uploaded file instance by the given content.
     *
     * @param array $headingRow
     * @param array $data
     *
     * @return bool|UploadedFile
     */
    public function createFakeXlsxUploadedFileWithContent(array $headingRow, array $data)
    {
        // Create a Fake Storage Disk.
        Storage::fake($this->fakeDiskName);

        // Get a Fake Exportable Class.
        $fakeExportableClass = $this->getFakeAnonymousExportableClass($headingRow, $data);

        $file_name = 'fake-file.xlsx';

        // Store the Content by the Exportable Class to recently created Fake Disk.
        if (! Excel::store($fakeExportableClass, $file_name, $this->fakeDiskName, \Maatwebsite\Excel\Excel::XLSX)) {
            return false;
        }

        // Create and return a Test Uploaded Instance by the recently stored file.
        return $this->createUploadedFileInstance($file_name);
    }

    /**
     * Get a fake Exportable Class by PHP Anonymous class by the given content.
     *
     * @param array $headingRow
     * @param array $data
     *
     * @return FromCollection|WithHeadings|__anonymous@6755
     */
    private function getFakeAnonymousExportableClass(array $headingRow, array $data)
    {
        return new class($headingRow, $data) extends DefaultValueBinder implements WithCustomValueBinder, FromArray, WithHeadings {
            /**
             * The file content as array.
             *
             * @var array $data
             */
            private array $data;

            /**
             * The File Headers as array.
             *
             * @var array $headingRow
             */
            private array $headingRow;

            public function __construct($headingRow, $data)
            {
                $this->data       = $data;
                $this->headingRow = $headingRow;
            }

            /**
             * Export to a file by the given data.
             *
             * @return array
             */
            public function array(): array
            {
                return $this->data;
            }

            /**
             * The Exported File Heading Row.
             *
             * @return array
             */
            public function headings(): array
            {
                return $this->headingRow;
            }

            public function bindValue(Cell $cell, $value)
            {
                if (is_numeric($value)) {
                    $cell->setValueExplicit($value, DataType::TYPE_STRING);

                    return true;
                }

                // else return default behavior
                return parent::bindValue($cell, $value);
            }
        };
    }

    /**
     * @param string $file_name
     *
     * @return UploadedFile
     */
    private function createUploadedFileInstance(string $file_name): UploadedFile
    {
        // Get the Full Path using the file name.
        // path = storage path / file name
        $fullPath = Storage::disk($this->fakeDiskName)->path($file_name);

        return new UploadedFile($fullPath, $file_name, null, 0, true);
    }
}
