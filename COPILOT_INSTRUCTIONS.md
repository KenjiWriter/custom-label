# GitHub Copilot Instructions for VS Code - Custom-Label Project

## Purpose
Outline best practices for using GitHub Copilot (powered by Claude Sonnet 3.7 thinking) in VS Code when working with large files and controller tasks. These guidelines will help maintain context, break down complex tasks, and ensure consistent code generation across the Custom-Label codebase.

## Prerequisites
- VS Code with GitHub Copilot extension installed.
- Model configured to use Claude Sonnet 3.7 thinking.
- Familiarity with repository structure, especially `src/controllers`.

## Setup
1. In VS Code settings, set:
   ```json
   "github.copilot.model": "claude-sonnet-3.7-thinking"
   ```
2. Enable inline suggestions and enable “rich context” for large files:
   ```json
   "github.copilot.largeFileSupport": true
   ```

## Working with Large Files
1. Summarize chunks:
   - Select a logical section (~200–300 lines), trigger Copilot to summarize:  
     “Summarize the responsibilities and key functions in this section.”
2. Use extracted summaries as prompts when editing distant parts of the file.
3. Break code into smaller virtual “chunks” by controllers or modules.

## Controller-Specific Guidelines
1. Identify endpoint tasks:
   - Locate `src/controllers/*.ts` files.
   - For each exported handler or method:
     - Ask: “Generate validation logic for `<methodName>` input based on existing DTOs.”
     - Ask: “Create error handling middleware for `<methodName>`.”
2. Maintain context:
   - Provide Copilot with the function signature and its summary.
   - Example prompt:
     ```js
     // Context: This function registers a new label with properties {name, color}.
     // Task: Implement database transaction logic using Prisma.
     ```
3. Consistency across controllers:
   - Use standardized prompts:
     - “Follow naming conventions: camelCase, async/await.”
     - “Write JSDoc for every public handler.”

## Prompt Examples
- “Refactor this controller to extract common logic into a service function.”
- “Add pagination support to `getAllLabels` handler, using page and limit query parameters.”
- “Write unit tests for `updateLabel` method, mocking the database calls.”

## Tips
- Use multi-line prompts inside comments for clarity.
- Periodically regenerate summaries after significant changes.
- Review Copilot’s suggestions carefully—especially around transactions and error handling.

## Further Reading
- VS Code Copilot docs: https://docs.github.com/en/copilot
- Claude Sonnet 3.7 model overview: <model-docs-url>
