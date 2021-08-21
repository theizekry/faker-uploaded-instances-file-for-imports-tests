<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\FakerUploadedInstanceGenerator\Traits\CreateFakeUploadedFileObjectWithContent;

class UsersImportTest extends TestCase
{
    use CreateFakeUploadedFileObjectWithContent;
    # use RefreshDatabase;

    /**
     * Laravel Faker.
     *
     * @var Object $faker
     */
    private Object $faker;

    /**
     * Setup method.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    /** @test */
    public function it_should_getting_validations_errors_while_file_is_not_sent()
    {
        $this->json('post', 'users/import')
            ->assertStatus(422)
            ->assertJsonFragment([
                'errors' => [
                    'file' => [
                        'The file field is required.'
                    ],
                ],
            ]);
    }
    
    /**
     * Test with CSV File.
     *
     * @test
     *
     * @return void
     */
    public function it_can_import_users_successfully_while_the_sent_csv_file_has_valid_data()
    {
        // okay, Let's play with files and use our trait to get files with dynamic contents.

        $headingRow = [
            'name',
            'email',
            'password',
        ];

        $data = [
            $row_1  = [
                $this->faker->name,
                $this->faker->email,
                $this->faker->password(8),
            ],
            $row_2 = [
                $this->faker->name,
                $this->faker->email,
                $this->faker->password(8),
            ],
        ];

        $uploadedFileInstance = $this->createFakeCsvUploadedFileWithContent(
            $headingRow,
            $data
        );

        // Calling the api with recently generated file.
        $this->json('post', 'users/import', [
                'file' => $uploadedFileInstance,
            ])
            ->assertStatus(200);
    }

    /**
     * Test with XLS File.
     *
     * @test
     *
     * @return void
     */
    public function it_can_import_users_successfully_while_the_sent_xls_file_has_valid_data()
    {
        // okay, Let's play with files and use our trait to get files with dynamic contents.

        $headingRow = [
            'name',
            'email',
            'password',
        ];

        $data = [
            $row_1  = [
                $this->faker->name,
                $this->faker->email,
                $this->faker->password(8),
            ],
            $row_2 = [
                $this->faker->name,
                $this->faker->email,
                $this->faker->password(8),
            ],
        ];

        $uploadedFileInstance = $this->createFakeXlsUploadedFileWithContent(
            $headingRow,
            $data
        );

        // Calling the api with recently generated file.
        $this->json('post', 'users/import', [
                'file' => $uploadedFileInstance,
            ])
            ->assertStatus(200);
    }

    /**
     * Test with XLSX File.
     *
     * @test
     *
     * @return void
     */
    public function it_can_import_users_successfully_while_the_sent_xlsx_file_has_valid_data()
    {
        // okay, Let's play with files and use our trait to get files with dynamic contents.

        $headingRow = [
            'name',
            'email',
            'password',
        ];

        $data = [
            $row_1  = [
                $this->faker->name,
                $this->faker->email,
                $this->faker->password(8),
            ],
            $row_2 = [
                $this->faker->name,
                $this->faker->email,
                $this->faker->password(8),
            ],
        ];

        $uploadedFileInstance = $this->createFakeXlsxUploadedFileWithContent(
            $headingRow,
            $data
        );

        // Calling the api with recently generated file.
        $this->json('post', 'users/import', [
                'file' => $uploadedFileInstance,
            ])
            ->assertStatus(200);
    }

    /** @test */
    public function it_should_fails_because_of_validation_errors_for_invalid_email_in_first_row()
    {
        $headingRow = [
            'name',
            'email',
            'password',
        ];

        $data = [
            $row_1  = [
                $this->faker->name,
                'an-invalid-email-format',
                $this->faker->password(8),
            ],
        ];

        $uploadedFileInstance = $this->createFakeXlsxUploadedFileWithContent(
            $headingRow,
            $data
        );

        // Calling the api with recently generated file.
        $this->json('post', 'users/import', [
            'file' => $uploadedFileInstance,
        ])
            ->assertStatus(422)
            ->assertJsonFragment([
                'errors' => [
                    [
                        'There was an error on row 2. The email must be a valid email address.',
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_should_fails_because_of_validation_errors_for_invalid_password()
    {
        $headingRow = [
            'name',
            'email',
            'password',
        ];

        $data = [
            $row_1  = [
                $this->faker->name,
                $this->faker->email,
                'foobar', // invalid Length for password.
            ],
        ];

        $uploadedFileInstance = $this->createFakeXlsxUploadedFileWithContent(
            $headingRow,
            $data
        );

        // Calling the api with recently generated file.
        $this->json('post', 'users/import', [
            'file' => $uploadedFileInstance,
        ])
            ->assertStatus(422)
            ->assertJsonFragment([
                'errors' => [
                    [
                        'There was an error on row 2. The password must be at least 8 characters.',
                    ],
                ],
            ]);
    }
}
