<?php

namespace TeamMembersDirectory\Tests;

use PHPUnit\Framework\TestCase;
use TeamMembersDirectory\Services\TeamMemberValidator;

class TeamMemberValidatorTest extends TestCase{
    public function testValidateWithValidData(): void{
        $data=[
            'full_name' => 'John Doe',
            'role_title' => 'Developer',
            'email' => 'john@example.com',
        ];

        $errors = TeamMemberValidator::validate($data);

        $this->assertEmpty($errors, 'Valid data should not produce errors');
    }

    public function testValidateWithMissingFullName(): void{
        $data=[
            'full_name' => '',
            'role_title' => 'Developer',
            'email' => 'john@example.com',
        ];

        $errors = TeamMemberValidator::validate($data);

        $this->assertNotEmpty($errors, 'Missing full_name should produce errors');
        $this->assertArrayHasKey('full_name', $errors);
        $this->assertEquals('Full Name is required.', $errors['full_name']);
    }

    public function testValidateWithMissingRoleTitle(): void{
        $data=[
            'full_name' => 'John Doe',
            'role_title' => '',
            'email' => 'john@example.com',
        ];

        $errors = TeamMemberValidator::validate($data);

        $this->assertNotEmpty($errors, 'Missing role_title should produce errors');
        $this->assertArrayHasKey('role_title', $errors);
        $this->assertEquals('Role/Title is required.', $errors['role_title']);
    }

    public function testValidateWithInvalidEmail(): void{
        $data=[
            'full_name' => 'John Doe',
            'role_title' => 'Developer',
            'email' => 'invalid-email',
        ];

        $errors = TeamMemberValidator::validate($data);

        $this->assertNotEmpty($errors, 'Invalid email should produce errors');
        $this->assertArrayHasKey('email', $errors);
        $this->assertEquals('Email must be a valid email address.', $errors['email']);
    }

    public function testValidateWithEmptyEmail(): void{
        $data=[
            'full_name' => 'John Doe',
            'role_title' => 'Developer',
            'email' => '',
        ];

        $errors = TeamMemberValidator::validate($data);

        $this->assertEmpty($errors, 'Empty email should be allowed (optional field)');
    }

    public function testValidateWithValidEmailAndAllFields(): void{
        $data=[
            'full_name' => 'Jane Smith',
            'role_title' => 'Designer',
            'email' => 'jane.smith@example.com',
        ];

        $errors = TeamMemberValidator::validate($data);

        $this->assertEmpty($errors, 'All valid data should pass validation');
    }

    public function testValidateWithMultipleErrors(): void{
        $data=[
            'full_name' => '',
            'role_title' => '',
            'email' => 'bad-email',
        ];

        $errors = TeamMemberValidator::validate($data);

        $this->assertCount(3, $errors, 'Should have 3 validation errors');
        $this->assertArrayHasKey('full_name', $errors);
        $this->assertArrayHasKey('role_title', $errors);
        $this->assertArrayHasKey('email', $errors);
    }
}