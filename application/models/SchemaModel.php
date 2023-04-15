<?php

class SchemaModel extends CI_Model
{
    public function __construct()
    {
        $this->load->dbforge();
    }

    public function run()
    {
        $this->createUsersTable();
        $this->createRolesTable();
        $this->createPermissionsTable();
        $this->createRolePermissionsTable();
        $this->createUserRolesTable();
        $this->createCandidatesTable();
        $this->createResumeTable();
        $this->addColumnToResumeTable();
        $this->addColumnToResumeTableOnePointNine();
        $this->createResumeExperienceTable();
        $this->createResumeSkillTable();
        $this->createResumeLanguageTable();
        $this->createResumeQualificationTable();
        $this->createResumeAchievementsTable();
        $this->createResumeReferencesTable();
        $this->createJobsTable();
        $this->addColumnsToJobTable();
        $this->createJobFiltersTable();
        $this->addColumnToJobFiltersTable();
        $this->createJobFilterValuesTable();
        $this->createJobFilterValueAssignmentsTable();
        $this->createJobsCustomFieldsTable();
        $this->createDepartmentsTable();
        $this->createCompaniesTable();
        $this->createTraitsTable();
        $this->createJobTraitsTable();
        $this->createJobTraitAnswersTable();
        $this->createJobApplicationsTable();
        $this->createJobFavoritesTable();
        $this->createJobReferredTable();
        $this->createBlogCategoriesTable();
        $this->createBlogsTable();
        $this->createFooterSectionsTable();
        $this->createSettingsTable();
        $this->createToDosTable();
        $this->createLanguagesTable();
        $this->addColumnsToLanguagesTable();
        $this->createAppUpdateTable();

        $this->importSettings();
        $this->importUpdate();        
        $this->importFooterSections();
        $this->importPermissionsData();
    }

    private function createUsersTable()
    {
        $fields = array(
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'first_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'last_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'username' => array('type' => 'VARCHAR', 'constraint' => '100', 'unique' => TRUE,),
            'email' => array('type' => 'VARCHAR', 'constraint' => '150', 'unique' => TRUE,),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'password' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'status' => array('type' => 'TINYINT',),
            'token' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'user_type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'admin',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('users', $fields, 'user_id');
    }

    private function createCandidatesTable()
    {
        $fields = array(
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'first_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'last_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'email' => array('type' => 'VARCHAR', 'constraint' => '150', 'unique' => TRUE,),
            'password' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'phone1' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'phone2' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'city' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'state' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'country' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'address' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'gender' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'dob' => array('type' => 'DATETIME', 'null' => TRUE,),
            'bio' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'account_type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'site', 'null' => TRUE,),
            'external_id' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE,),
            'token' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('candidates', $fields, 'candidate_id');
    }

    private function createResumeTable()
    {
        $fields = array(
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'designation' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'objective' => array('type' => 'TEXT',),
            'status' => array('type' => 'TINYINT',),
            'type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'detailed', 'null' => TRUE,),
            'file' => array('type' => 'VARCHAR', 'constraint' => '200',),
            'experience' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'experiences' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'qualifications' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'languages' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'achievements' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'references' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'is_default' => array('type' => 'TINYINT', 'default' => 1),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resumes', $fields, 'resume_id');
    }

    private function addColumnToResumeTable()
    {
        if ($this->db->table_exists('resumes')) {
            if (!$this->db->field_exists('is_default', 'resumes')) {
                $field = array('is_default' => array('type' => 'TINYINT', 'default' => 1, 'after' => 'references'));
                $this->dbforge->add_column('resumes', $field);
            }
        }
    }

    private function addColumnToResumeTableOnePointNine()
    {
        if ($this->db->table_exists('resumes')) {
            if (!$this->db->field_exists('experiences_all', 'resumes')) {
                $field = array('experiences_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'experiences'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('qualifications_all', 'resumes')) {
                $field = array('qualifications_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'qualifications'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('skills', 'resumes')) {
                $field = array('skills' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'qualifications_all'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('skills_all', 'resumes')) {
                $field = array('skills_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'skills'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('languages_all', 'resumes')) {
                $field = array('languages_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'languages'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('achievements_all', 'resumes')) {
                $field = array('achievements_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'achievements'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('references_all', 'resumes')) {
                $field = array('references_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'references'));
                $this->dbforge->add_column('resumes', $field);
            }
        }
    }    

    private function createResumeExperienceTable()
    {
        $fields = array(
            'resume_experience_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'company' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'from' => array('type' => 'DATETIME', 'null' => TRUE,),
            'to' => array('type' => 'DATETIME', 'null' => TRUE,),
            'description' => array('type' => 'TEXT',),
            'is_current' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_experiences', $fields, 'resume_experience_id');
    }

    private function createResumeSkillTable()
    {
        //Version 1.9
        $fields = array(
            'resume_skill_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'proficiency' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_skills', $fields, 'resume_skill_id');
    }

    private function createResumeLanguageTable()
    {
        $fields = array(
            'resume_language_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'proficiency' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_languages', $fields, 'resume_language_id');
    }

    private function createResumeQualificationTable()
    {
        $fields = array(
            'resume_qualification_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'institution' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'marks' => array('type' => 'DOUBLE',),
            'out_of' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'from' => array('type' => 'DATETIME', 'null' => TRUE,),
            'to' => array('type' => 'DATETIME', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_qualifications', $fields, 'resume_qualification_id');
    }

    private function createResumeAchievementsTable()
    {
        $fields = array(
            'resume_achievement_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'link' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'date' => array('type' => 'DATETIME', 'null' => TRUE,),
            'type' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_achievements', $fields, 'resume_achievement_id');
    }

    private function createResumeReferencesTable()
    {
        $fields = array(
            'resume_reference_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'relation' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'company' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'email' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_references', $fields, 'resume_reference_id');
    }

    private function createRolesTable()
    {
        $fields = array(
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('roles', $fields, 'role_id');
    }

    private function createPermissionsTable()
    {
        $fields = array(
            'permission_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'category' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '100',),
        );
        $this->createTable('permissions', $fields, 'permission_id');
    }

    private function createRolePermissionsTable()
    {
        $fields = array(
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'permission_id' => array('type' => 'INT', 'unsigned' => TRUE,),
        );
        $this->createTable('role_permissions', $fields);
    }

    private function createUserRolesTable()
    {
        $fields = array(
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE,),
        );
        $this->createTable('user_roles', $fields);
    }

    private function createPagesTable()
    {
        $fields = array(
            'page_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'default' => 0,),
            'sidebar_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'sidebar_alignment' => array('type' => 'ENUM("left","right")', 'default' => 'right',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'description' => array('type' => 'TEXT',),
            'keywords' => array('type' => 'TEXT',),
            'summary' => array('type' => 'TEXT',),
            'status' => array('type' => 'TINYINT',),
            'is_default' => array('type' => 'TINYINT',),
            'is_home' => array('type' => 'TINYINT',),
            'order' => array('type' => 'TINYINT', 'default' => 0,),
            'is_menu_enabled' => array('type' => 'TINYINT', 'default' => 1,),
            'parent_id' => array('type' => 'INT', 'default' => 0,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('pages', $fields, 'page_id');
    }

    private function createFooterSectionsTable()
    {
        $fields = array(
            'footer_section_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'content' => array('type' => 'TEXT',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('footer_sections', $fields, 'footer_section_id');
    }    

    private function createSettingsTable()
    {
        $fields = array(
            'setting_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'type' => array('type' => 'VARCHAR', 'constraint' => '80', 'null' => TRUE,),
            'category' => array('type' => 'VARCHAR', 'constraint' => '80', 'null' => TRUE,),
            'description' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'key' => array('type' => 'VARCHAR', 'constraint' => '250',),
            //'value' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
            'value' => array('type' => 'TEXT', 'null' => TRUE,),
            'options' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
        );
        $this->createTable('settings', $fields, 'setting_id');
    }

    private function createToDosTable()
    {
        $fields = array(
            'to_do_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('to_dos', $fields, 'to_do_id');
    }

    private function createJobsTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'company_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'department_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'is_static_allowed' => array('type' => 'TINYINT', 'default' => '0',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('jobs', $fields, 'job_id');
    }

    private function addColumnsToJobTable()
    {
        //Added in Version 1.8
        if ($this->db->table_exists('jobs')) {
            if (!$this->db->field_exists('slug', 'jobs')) {
                $field = array('slug' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE, 'after' => 'title'));
                $this->dbforge->add_column('jobs', $field);

                //Adding slugs for existing jobs
                $jobs = $this->AdminJobModel->getAll(false);
                foreach ($jobs as $j) {
                    $d['slug'] = $this->AdminJobModel->getSlug($j['title'], '', encode($j['job_id']));
                    $this->db->where('jobs.job_id', $j['job_id']);
                    $this->db->update('jobs', $d);
                }
            }
            if (!$this->db->field_exists('meta_keywords', 'jobs')) {
                $field = array('meta_keywords' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'description'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('meta_description', 'jobs')) {
                $field = array('meta_description' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'meta_keywords'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('min_salary', 'jobs')) {
                $field = array('min_salary' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE, 'after' => 'meta_description'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('max_salary', 'jobs')) {
                $field = array('max_salary' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE, 'after' => 'min_salary'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('created_by', 'jobs')) {
                $field = array('created_by' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'after' => 'min_salary'));
                $this->dbforge->add_column('jobs', $field);
            }            
        }
    }    

    private function createJobFiltersTable()
    {
        $fields = array(
            'job_filter_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'order' => array('type' => 'TINYINT',),
            'admin_filter' => array('type' => 'TINYINT', 'default' => '1',),
            'front_filter' => array('type' => 'TINYINT', 'default' => '1',),
            'front_value' => array('type' => 'TINYINT', 'default' => '1',),
            'type' => array('type' => 'VARCHAR', 'constraint' => '50',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_filters', $fields, 'job_filter_id');
    }

    private function addColumnToJobFiltersTable()
    {
        if ($this->db->table_exists('job_filters')) {
            if (!$this->db->field_exists('front_home_filter', 'job_filters')) {
                $field = array('front_home_filter' => array('type' => 'TINYINT', 'default' => 0, 'after' => 'front_filter'));
                $this->dbforge->add_column('job_filters', $field);
            }
        }
    }    

    private function createJobFilterValuesTable()
    {
        $fields = array(
            'job_filter_value_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_filter_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
        );
        $this->createTable('job_filter_values', $fields, 'job_filter_value_id');
    }

    private function createJobFilterValueAssignmentsTable()
    {
        $fields = array(
            'job_filter_value_assignment_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_filter_value_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_filter_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
        );
        $this->createTable('job_filter_value_assignments', $fields, 'job_filter_value_assignment_id');
    }

    private function createJobsCustomFieldsTable()
    {
        $fields = array(
            'custom_field_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'label' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'value' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_custom_fields', $fields, 'custom_field_id');
    }

    private function createDepartmentsTable()
    {
        $fields = array(
            'department_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('departments', $fields, 'department_id');
    }

    private function createCompaniesTable()
    {
        $fields = array(
            'company_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('companies', $fields, 'company_id');
    }

    private function createTraitsTable()
    {
        $fields = array(
            'trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('traits', $fields, 'trait_id');
    }

    private function createJobTraitsTable()
    {
        $fields = array(
            'job_trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_traits', $fields, 'job_trait_id');
    }

    private function createJobTraitAnswersTable()
    {
        $fields = array(
            'job_trait_answer_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_trait_title' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => TRUE),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_application_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'rating' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_trait_answers', $fields, 'job_trait_answer_id');
    }

    private function createJobApplicationsTable()
    {
        $fields = array(
            'job_application_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'status' => array('type' => 'ENUM("applied","shortlisted","interviewed","hired","rejected")', 'default' => 'applied',),            
            'traits_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'quizes_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'interviews_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'overall_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_applications', $fields, 'job_application_id');
    }

    private function createJobFavoritesTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_favorites', $fields);
    }

    private function createJobReferredTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'email' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '50',),
            'name' => array('type' => 'VARCHAR', 'constraint' => '50',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_referred', $fields);
    }

    private function createBlogCategoriesTable()
    {
        $fields = array(
            'blog_category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('blog_categories', $fields, 'blog_category_id');
    }

    private function createBlogsTable()
    {
        $fields = array(
            'blog_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'blog_category_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'TEXT',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('blogs', $fields, 'blog_id');
    }    

    private function createLanguagesTable()
    {
        $fields = array(
            'language_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT',),
            'is_selected' => array('type' => 'TINYINT',),
            'is_default' => array('type' => 'TINYINT', 'default' => '0',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('languages', $fields, 'language_id');
    }

    private function addColumnsToLanguagesTable()
    {
        if ($this->db->table_exists('languages')) {
            if (!$this->db->field_exists('direction', 'languages')) {
                $field = array('direction' => array('type' => 'VARCHAR', 'constraint' => '15', 'null' => TRUE, 'after' => 'is_default', 'default' => 'rtl'));
                $this->dbforge->add_column('languages', $field);
            }
            if (!$this->db->field_exists('display', 'languages')) {
                $field = array('display' => array('type' => 'VARCHAR', 'constraint' => '15', 'null' => TRUE, 'after' => 'direction', 'default' => 'both'));
                $this->dbforge->add_column('languages', $field);
            }
            if (!$this->db->field_exists('flag', 'languages')) {
                $field = array('flag' => array('type' => 'VARCHAR', 'constraint' => '15', 'null' => TRUE, 'after' => 'display', 'default' => 'us'));
                $this->dbforge->add_column('languages', $field);
            }
            if (!$this->db->field_exists('is_main', 'languages')) {
                $field = array('is_main' => array('type' => 'TINYINT', 'default' => 0, 'after' => 'status'));
                $this->dbforge->add_column('languages', $field);
            }            
        }
    }    

    private function createAppUpdateTable()
    {
        $fields = array(
            'update_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'version' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'details' => array('type' => 'TEXT', 'null' => TRUE,),
            'files' => array('type' => 'TEXT', 'null' => TRUE,),
            'is_current' => array('type' => 'TINYINT', 'default' => '0',),
            'released_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('updates', $fields, 'update_id');
    }

    private function createTable($table, $fields, $key = null)
    {
        $this->dbforge->add_field($fields);
        if ($key) {
            $this->dbforge->add_key($key, TRUE);
        }
        $this->dbforge->create_table($table, TRUE);
    }

    public function importSettings()
    {
        $googleTut = '<a href="https://code.tutsplus.com/tutorials/create-a-google-login-page-in-php--cms-33214" target="_blank">Google Login</a>';
        $linkedinTut = '<a href="https://www.linkedin.com/developers/login" target="_blank">Linkedin Login</a>';
        $smtpTutorial = '<a href="#">Email Settings</a>';
        $bannerText = '<h2>Looking for an exciting career path ?<br>Come, Join Us!</h2>
        <a href="'.CF_BASE_URL.'/register" class="btn-get-started scrollto">Register Now</a>';
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'candidatefinder.com';
        $host = str_replace('www.', '', $host);
        $fromEmail = 'hr@'.$host;

        $data = array(

            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'default-landing-page', 'value' => 'home', 'description' => 'Default landing page', 'options' => '["home", "jobs", "news"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'home-banner', 'value' => 'yes', 'description' => 'Display home page banner', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'how-it-works', 'value' => 'yes', 'description' => 'Enable How it works section', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'department-section', 'value' => 'yes', 'description' => 'Enable Department Section', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'news-section', 'value' => 'yes', 'description' => 'Enable News Section', 'options' => '["yes", "no"]'),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'banner-text', 
                'value' => $bannerText, 'description' => 'Banner Text', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'before-how', 'value' => '', 
                'description' => 'Text Before How It Works Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'after-how', 'value' => '', 
                'description' => 'Text After How It Works Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'before-news', 'value' => '', 
                'description' => 'Text Before News Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'after-news', 'value' => '', 
                'description' => 'Text After News Section', 'options' => ''),

            array('type' => 'image', 'user_id' => 0, 'category' => 'General', 'key' => 'site-logo', 'value' => 'site-logo.png', 'description' => 'Select site logo'),
            array('type' => 'image', 'user_id' => 0, 'category' => 'General', 'key' => 'site-banner-image', 'value' => '', 'description' => 'Select home page banner'),
            array('type' => 'image', 'user_id' => 0, 'category' => 'General', 'key' => 'site-favicon', 'value' => 'site-favicon.png', 'description' => 'Select favicon'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'site-name', 'value' => 'Candidate Finder', 'description' => 'Define site name', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'admin-email', 'value' => 'admin@example.com', 'description' => 'Define admin email', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'from-email', 'value' => $fromEmail, 'description' => 'Define from email for mail send', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'purchase-code', 'value' => 'test', 'description' => 'Enter purchase code', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'General', 'key' => 'site-keywords', 'value' => 'candidate finder', 'description' => 'Define Site Keywords', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'General', 'key' => 'site-description', 'value' => 'candidate finder', 'description' => 'Define Site Description', 'options' => ''),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'jobs-limit', 'value' => '10', 'description' => 'No of jobs to display per page', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'blogs-limit', 'value' => '10', 'description' => 'No of blogs to display per page', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'charts-limit', 'value' => '5', 'description' => 'Chart elements count on Dashboard', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-email-verification', 'value' => 'yes', 'description' => 'Enable email verification on register.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-forgot-password', 'value' => 'yes', 'description' => 'Enable forgot/recover password feature.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-register', 'value' => 'yes', 'description' => 'Enable new user register feature.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-multiple-resume', 'value' => 'no', 'description' => 'Enable multiple resume for a candidate.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-apply-without-static-resume', 'value' => 'no'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-admin-lang-select', 'value' => 'yes'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-front-lang-select', 'value' => 'yes'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-front-salary-filter', 'value' => 'yes'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'front-salary-filter-min-value', 'value' => '0'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'front-salary-filter-max-value', 'value' => '100000'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'salary-currency', 'value' => '$'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'limit-team-members-to-only-view-their-created-jobs', 'value' => 'no'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-overall-result-edit', 'value' => 'no'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'display-candidate-interviews', 'value' => 'description_only'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'display-jobs-to-only-logged-in-users', 'value' => 'no'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-qualifications-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-experiences-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-achievements-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-skills-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-languages-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-references-resume-nos-required', 'value' => '1',),


            array('type' => 'heading', 'user_id' => 0, 'category' => 'General', 'key' => $smtpTutorial, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp', 'value' => 'no', 'description' => 'Enable external smtp for emails (selecting no will use default hosting email settings e.g. sendmail)', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-host', 'value' => 'ssl://smtp.googlemail.com', 'description' => 'Define smtp host.', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-port', 'value' => '465', 'description' => 'Define smtp port.', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-username', 'value' => 'your-gmail@gmail.com', 'description' => 'Define smtp username.', 'options' => ''),
            array('type' => 'password', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-password', 'value' => 'Abcd1234!', 'description' => 'Define smtp password.', 'options' => ''),


            //Apis menu
            array('type' => 'heading', 'user_id' => 0, 'category' => 'Apis', 'key' => $googleTut, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Apis', 'key' => 'enable-google-login', 'value' => 'yes', 'description' => 'Enable google login.', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-client-id', 'value' => 'abcd1234', 'description' => 'Define Google client id', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-client-secret', 'value' => 'abcd1234', 'description' => 'Define Google client secret', 'options' => ''),
            array('type' => 'readonly', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-app-redirect', 'value' => CF_BASE_URL.'/google-redirect', 'description' => 'Paste this redirect uri in google app console.', 'options' => ''),

            array('type' => 'heading', 'user_id' => 0, 'category' => 'Apis', 'key' => $linkedinTut, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Apis', 'key' => 'enable-linkedin-login', 'value' => 'yes', 'description' => 'Enable linkedin login.', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-id', 'value' => 'abcd1234', 'description' => 'Define linkedin App id', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-secret', 'value' => 'abcd1234', 'description' => 'Define linkedin App secret', 'options' => ''),
            array('type' => 'readonly', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-redirect', 'value' => CF_BASE_URL.'/linkedin-redirect', 'description' => 'Paste this redirect uri in linkedin app console.', 'options' => ''),

            //Colors Alignment menu
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'banner-text-color',  'value' => '#f4f4f4', 'description' => 'Select Banner text color'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'site-background',  'value' => '#f4f4f4', 'description' => 'Select background color for site content area (#f4f4f4)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'headings-underline-color',  'value' => '#56c7ff', 'description' => 'Select colors for heading underline (#56c7ff)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-background', 'value' => '#1D3352', 'description' => 'Select background color for footer (#1D3352)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-items-color', 'value' => '#FFFFFF', 'description' => 'Select items color for footer (#FFFFFF)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-social-icons-color',  'value' => '#56c7ff', 'description' => 'Define color for footer social icons (#56c7ff)'),

        );

        foreach ($data as $d) {
            $d['value'] = str_replace('"', "'", $d['value']);
            $this->db->where('key', $d['key']);
            $this->db->where('user_id', 0);
            $result = $this->db->get('settings');
            if ($result->num_rows() <= 0) {
                $this->db->insert('settings', $d);
            }
        }
    }

    public function importUpdate()
    {
        $data = array(
            array('title' => 'Initial', 'version' => '1.9', 'details' => 'Initial Installation<br />', 'files' => '', 'is_current' => 1, 'released_at' => '2022-09-15 00:00:00', 'created_at' => date('Y-m-d G:i:s')),
        );
        foreach ($data as $d) {
            $this->db->where('version', $d['version']);
            $result = $this->db->get('updates');
            if ($result->num_rows() <= 0) {
                $this->db->insert('updates', $d);
            }
        }
    }
 
    public function importFooterSections()
    {
        $data = array(
            array(
                'title' => 'Column 1',
                'content' => getTextFromFile('col1.txt'),
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 2',
                'content' => '<div class="footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><a href="'.CF_BASE_URL.'/blog/'.encode(2).'">How To Apply</a></li>
                                <li><a href="'.CF_BASE_URL.'/jobs">Latest Jobs</a></li>
                                <li><a href="'.CF_BASE_URL.'/account">My Account</a></li>
                                <li><a href="'.CF_BASE_URL.'/blogs">News & Announcements</a></li>
                                <li><a href="'.CF_BASE_URL.'/blog/'.encode(4).'">Privacy policy</a></li>
                            </ul>
                            </div>',
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 3',
                'content' => '<div class="footer-links">
                            <h4>Latest Jobs</h4>
                            <ul>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(1).'">Marketing Executive</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(2).'">Accounts Manager</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(3).'">Computer System Analyst</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(4).'">Network Administrator</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(5).'">Project Manager</a></li>
                            </ul>
                            </div>',
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 4',
                'content' => getTextFromFile('col2.txt'),
                'updated_at' => date('Y-m-d G:i:s')
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('footer_sections');
            if ($result->num_rows() <= 0) {
                $this->db->insert('footer_sections', $d);
            }
        }
    }    

    public function importPermissionsData()
    {
        $data = array(
            //Dashboard
            array('category' => 'dashboard', 'title' => 'view dashboard stats', 'slug' => 'view_dashboard_stats',),
            array('category' => 'dashboard', 'title' => 'view job chart', 'slug' => 'view_job_chart',),
            array('category' => 'dashboard', 'title' => 'view candidate chart', 'slug' => 'view_candidate_chart',),
            array('category' => 'dashboard', 'title' => 'view jobs status', 'slug' => 'view_jobs_status',),
            array('category' => 'dashboard', 'title' => 'to do list', 'slug' => 'to_do_list',),
            //Job Board
            array('category' => 'job_board', 'title' => 'view job board', 'slug' => 'view_job_board',),
            array('category' => 'job_board', 'title' => 'actions job board', 'slug' => 'actions_job_board',),
            //Jobs
            array('category' => 'jobs', 'title' => 'view jobs', 'slug' => 'view_jobs',),
            array('category' => 'jobs', 'title' => 'create jobs', 'slug' => 'create_jobs',),
            array('category' => 'jobs', 'title' => 'edit jobs', 'slug' => 'edit_jobs',),
            array('category' => 'jobs', 'title' => 'delete jobs', 'slug' => 'delete_jobs',),
            //Job Filters
            array('category' => 'job_filters', 'title' => 'view job filters', 'slug' => 'view_job_filters',),
            array('category' => 'job_filters', 'title' => 'create job filters', 'slug' => 'create_job_filters',),
            array('category' => 'job_filters', 'title' => 'edit job filters', 'slug' => 'edit_job_filters',),
            array('category' => 'job_filters', 'title' => 'delete job filters', 'slug' => 'delete_job_filters',),
            //Companies
            array('category' => 'companies', 'title' => 'view companies', 'slug' => 'view_companies',),
            array('category' => 'companies', 'title' => 'create companies', 'slug' => 'create_companies',),
            array('category' => 'companies', 'title' => 'edit companies', 'slug' => 'edit_companies',),
            array('category' => 'companies', 'title' => 'delete companies', 'slug' => 'delete_companies',),
            //Departments
            array('category' => 'departments', 'title' => 'view departments', 'slug' => 'view_departments',),
            array('category' => 'departments', 'title' => 'create departments', 'slug' => 'create_departments',),
            array('category' => 'departments', 'title' => 'edit departments', 'slug' => 'edit_departments',),
            array('category' => 'departments', 'title' => 'delete departments', 'slug' => 'delete_departments',),
            //Quizes
            array('category' => 'quizes', 'title' => 'view quiz questions', 'slug' => 'view_quiz_questions',),
            array('category' => 'quizes', 'title' => 'add quiz questions', 'slug' => 'add_quiz_questions',),
            array('category' => 'quizes', 'title' => 'edit quiz questions', 'slug' => 'edit_quiz_questions',),
            array('category' => 'quizes', 'title' => 'delete quiz questions', 'slug' => 'delete_quiz_questions',),
            array('category' => 'quizes', 'title' => 'view quizes', 'slug' => 'view_quizes',),
            array('category' => 'quizes', 'title' => 'add quizes', 'slug' => 'add_quizes',),
            array('category' => 'quizes', 'title' => 'edit quizes', 'slug' => 'edit_quizes',),
            array('category' => 'quizes', 'title' => 'delete quizes', 'slug' => 'delete_quizes',),
            array('category' => 'quizes', 'title' => 'clone quizes', 'slug' => 'clone_quizes',),
            array('category' => 'quizes', 'title' => 'download quizes', 'slug' => 'download_quizes',),
            //Interviews
            array('category' => 'interviews', 'title' => 'view interview questions', 'slug' => 'view_interview_questions',),
            array('category' => 'interviews', 'title' => 'add interview questions', 'slug' => 'add_interview_questions',),
            array('category' => 'interviews', 'title' => 'edit interview questions', 'slug' => 'edit_interview_questions',),
            array('category' => 'interviews', 'title' => 'delete interview questions', 'slug' => 'delete_interview_questions',),
            array('category' => 'interviews', 'title' => 'view interviews', 'slug' => 'view_interviews',),
            array('category' => 'interviews', 'title' => 'add interviews', 'slug' => 'add_interviews',),
            array('category' => 'interviews', 'title' => 'edit interviews', 'slug' => 'edit_interviews',),
            array('category' => 'interviews', 'title' => 'delete interviews', 'slug' => 'delete_interviews',),
            array('category' => 'interviews', 'title' => 'clone interviews', 'slug' => 'clone_interviews',),
            array('category' => 'interviews', 'title' => 'download interviews', 'slug' => 'download_interviews',),
            array('category' => 'interviews', 'title' => 'all candidate interviews', 'slug' => 'all_candidate_interviews',),
            array('category' => 'interviews', 'title' => 'view conduct interviews', 'slug' => 'view_conduct_interviews',),
            //Traits
            array('category' => 'traits', 'title' => 'view traits', 'slug' => 'view_traits',),
            array('category' => 'traits', 'title' => 'create traits', 'slug' => 'create_traits',),
            array('category' => 'traits', 'title' => 'edit traits', 'slug' => 'edit_traits',),
            array('category' => 'traits', 'title' => 'delete traits', 'slug' => 'delete_traits',),
            //Question Categories
            array('category' => 'question_categories', 'title' => 'view question categories', 'slug' => 'view_question_categories',),
            array('category' => 'question_categories', 'title' => 'create question categories', 'slug' => 'create_question_categories',),
            array('category' => 'question_categories', 'title' => 'edit question categories', 'slug' => 'edit_question_categories',),
            array('category' => 'question_categories', 'title' => 'delete question categories', 'slug' => 'delete_question_categories',),
            //Quiz Categories
            array('category' => 'quiz_categories', 'title' => 'view quiz categories', 'slug' => 'view_quiz_categories',),
            array('category' => 'quiz_categories', 'title' => 'create quiz categories', 'slug' => 'create_quiz_categories',),
            array('category' => 'quiz_categories', 'title' => 'edit quiz categories', 'slug' => 'edit_quiz_categories',),
            array('category' => 'quiz_categories', 'title' => 'delete quiz categories', 'slug' => 'delete_quiz_categories',),
            //Interview Categories
            array('category' => 'interview_categories', 'title' => 'view interview categories', 'slug' => 'view_interview_categories',),
            array('category' => 'interview_categories', 'title' => 'create interview categories', 'slug' => 'create_interview_categories',),
            array('category' => 'interview_categories', 'title' => 'edit interview categories', 'slug' => 'edit_interview_categories',),
            array('category' => 'interview_categories', 'title' => 'delete interview categories', 'slug' => 'delete_interview_categories',),
            //Questions
            array('category' => 'questions', 'title' => 'view questions', 'slug' => 'view_questions',),
            array('category' => 'questions', 'title' => 'create questions', 'slug' => 'create_questions',),
            array('category' => 'questions', 'title' => 'edit questions', 'slug' => 'edit_questions',),
            array('category' => 'questions', 'title' => 'delete questions', 'slug' => 'delete_questions',),
            //Team
            array('category' => 'team', 'title' => 'view team listing', 'slug' => 'view_team_listing',),
            array('category' => 'team', 'title' => 'add team member', 'slug' => 'add_team_member',),
            array('category' => 'team', 'title' => 'edit team member', 'slug' => 'edit_team_member',),
            array('category' => 'team', 'title' => 'delete team member', 'slug' => 'delete_team_member',),
            array('category' => 'team', 'title' => 'view roles', 'slug' => 'view_roles',),
            array('category' => 'team', 'title' => 'add role', 'slug' => 'add_role',),
            array('category' => 'team', 'title' => 'edit role', 'slug' => 'edit_role',),
            array('category' => 'team', 'title' => 'delete role', 'slug' => 'delete_role',),
            //Candidates
            array('category' => 'candidates', 'title' => 'view candidate listing', 'slug' => 'view_candidate_listing',),
            array('category' => 'candidates', 'title' => 'add candidate', 'slug' => 'add_candidate',),
            array('category' => 'candidates', 'title' => 'edit candidate', 'slug' => 'edit_candidate',),
            array('category' => 'candidates', 'title' => 'delete candidate', 'slug' => 'delete_candidate',),
            array('category' => 'candidates', 'title' => 'login as candidate', 'slug' => 'login_as_candidate',),
            //Blog
            array('category' => 'blog', 'title' => 'view blog listing', 'slug' => 'view_blog_listing',),
            array('category' => 'blog', 'title' => 'add blog', 'slug' => 'add_blog',),
            array('category' => 'blog', 'title' => 'edit blog', 'slug' => 'edit_blog',),
            array('category' => 'blog', 'title' => 'delete blog', 'slug' => 'delete_blog',),
            array('category' => 'blog', 'title' => 'view blog categories', 'slug' => 'view_blog_categories',),
            array('category' => 'blog', 'title' => 'add blog categories', 'slug' => 'add_blog_categories',),
            array('category' => 'blog', 'title' => 'edit blog categories', 'slug' => 'edit_blog_categories',),
            array('category' => 'blog', 'title' => 'delete blog categories', 'slug' => 'delete_blog_categories',),
            //Settings
            array('category' => 'settings', 'title' => 'general settings', 'slug' => 'general_settings',),
            array('category' => 'settings', 'title' => 'home page settings', 'slug' => 'home_page_settings',),
            array('category' => 'settings', 'title' => 'footer settings', 'slug' => 'footer_settings',),
            array('category' => 'settings', 'title' => 'apis settings', 'slug' => 'apis_settings',),
            array('category' => 'settings', 'title' => 'css settings', 'slug' => 'css_settings',),
            array('category' => 'settings', 'title' => 'languages settings', 'slug' => 'languages_settings',),
            array('category' => 'settings', 'title' => 'update application', 'slug' => 'update_application',),
        );
        foreach ($data as $d) {
            $this->db->where('slug', $d['slug']);
            $result = $this->db->get('permissions');
            if ($result->num_rows() <= 0) {
                $this->db->insert('permissions', $d);
                $id = $this->db->insert_id();
            }
        }
    }
   
}