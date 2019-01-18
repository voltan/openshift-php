<?php
/**
 * openshift user management example
 *
 * @author Hossein Azizabadi <azizabadi@faragostaresh.com>
 */

// Get information from url
$action = $_GET['action'];

// Do action
switch ($action) {
    // Create new user
    case 'create':

        // Get information from url
        $username = $_GET['username'];

        // Set command
        $command1 = sprintf('oc create user %s', $username);
        $command2 = sprintf('oc create identity ldap_provider:%s', $username);
        $command3 = sprintf('oc create useridentitymapping ldap_provider:%s %s', $username, $username);

        // DO command
        exec($command1, $output1);
        exec($command2, $output2);
        exec($command3, $output3);

        // Set result
        $result = [
            'status'  => 1,
            'message' => 'command run successfully',
            'body'    => [
                $output1,
                $output2,
                $output3
            ],
        ];

        break;

    // Set serviceaccount for user
    case 'serviceaccount':

        // Get information from url
        $username = $_GET['username'];

        // Set command
        $command = sprintf('oc create serviceaccount %s', $username);

        // DO command
        exec($command, $output);

        // Set result
        $result = [
            'status'  => 1,
            'message' => 'command run successfully',
            'body'    => $output,
        ];

        break;

    // Set role for user
    case 'role':

        // Get information from url
        $username = $_GET['username'];
        $role = isset($_GET['role']) ? $_GET['role'] : 'admin';
        $service = isset($_GET['service']) ? $_GET['service'] : 'test';

        // Set command
        $command = sprintf('oc policy add-role-to-user %s system:serviceaccounts:%s:%s', $role, $service, $username);

        // DO command
        exec($command, $output);

        // Set result
        $result = [
            'status'  => 1,
            'message' => 'command run successfully',
            'body'    => $output,
        ];

        break;

    // Get user name and return user token
    case 'token':

        // Get information from url
        $username = $_GET['username'];

        // Set command
        $command = sprintf('oc create serviceaccount %s', $username);

        // DO command
        exec($command, $output);

        // Set result
        $result = [
            'status'  => 1,
            'message' => 'command run successfully',
            'body'    => $output,
        ];

        break;

    default:
        $result = [
            'status'  => 0,
            'message' => 'No true action set',
            'body'    => [],
        ];
        break;
}

// Return result
header('Content-type: application/json');
echo json_encode($result);
exit();
