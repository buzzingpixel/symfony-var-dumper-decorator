import { Command } from '@oclif/core';
import { execSync } from 'node:child_process';
import * as fs from 'fs-extra';
import chalk from 'chalk';

export default class Build extends Command {
    public static summary = 'Build Docker images';

    public async run (): Promise<void> {
        const rootDir = fs.realpathSync(`${this.config.root}/../`);

        this.log(chalk.yellow(
            'Building buzzingpixel/symfony-var-dumper-decorator-php',
        ));

        execSync(
            `
                cd ${rootDir};
                docker build \
                    --build-arg BUILDKIT_INLINE_CACHE=1 \
                    --cache-from buzzingpixel/symfony-var-dumper-decorator-php \
                    --tag buzzingpixel/symfony-var-dumper-decorator-php \
                    --file ${rootDir}/docker/php/Dockerfile \
                    ${rootDir};
            `,
            { stdio: 'inherit' },
        );

        this.log(chalk.green(
            'Finished buzzingpixel/symfony-var-dumper-decorator-php',
        ));
    }
}
